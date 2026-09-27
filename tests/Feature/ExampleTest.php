<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WeddingSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guests_are_redirected_from_admin_settings(): void
    {
        $this->get(route('wedding.edit'))
            ->assertRedirect(route('login'));
    }

    public function test_public_invitation_slug_is_viewable_without_admin_access(): void
    {
        $setting = WeddingSetting::query()->create([
            'groom_name_en' => 'Groom Example',
            'bride_name_en' => 'Bride Example',
            'wedding_datetime' => '2027-11-18 07:00:00',
        ]);

        $this->get(route('wedding.preview', ['slug' => $setting->slug]))
            ->assertOk()
            ->assertSee('Groom Example')
            ->assertSee('Bride Example');

        $this->get(route('wedding.edit'))->assertRedirect(route('login'));
        $this->post(route('wedding.update'))->assertRedirect(route('login'));
        $this->get(route('wedding.preview', ['slug' => 'missing-wedding']))->assertNotFound();
    }

    public function test_guests_can_submit_an_rsvp_and_wish(): void
    {
        $this->post(route('wish.store'), [
            'guest_name' => 'Sophea',
            'attendance_status' => 'Yes',
            'guest_count' => 2,
            'message' => 'Wishing you a lifetime of happiness.',
        ])->assertRedirect(route('wedding.show') . '#rsvp');

        $this->assertDatabaseHas('wishes', [
            'guest_name' => 'Sophea',
            'attendance_status' => 'Yes',
            'guest_count' => 2,
            'message' => 'Wishing you a lifetime of happiness.',
        ]);
    }

    public function test_first_admin_can_register_and_claim_unowned_settings(): void
    {
        $setting = WeddingSetting::query()->create(['groom_name_en' => 'Groom']);

        $this->post(route('register'), [
            'name' => 'Admin User',
            'email' => 'ADMIN@example.com',
            'password' => 'wedding8',
            'password_confirmation' => 'wedding8',
        ])->assertRedirect(route('wedding.edit'));

        $user = User::query()->where('email', 'admin@example.com')->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertTrue(Hash::check('wedding8', $user->password));
        $this->assertSame($user->id, $setting->fresh()->user_id);

        $this->get(route('wedding.edit'))->assertOk()->assertSee(__('messages.admin_title'));
        $this->get(route('register'))->assertRedirect(route('wedding.edit'));
    }

    public function test_existing_admin_can_log_in_and_log_out(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'correct-horse-battery-12',
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'correct-horse-battery-12',
        ])->assertRedirect(route('wedding.edit'));

        $this->assertAuthenticatedAs($user);
        $this->post(route('logout'))->assertRedirect(route('wedding.show'));
        $this->assertGuest();
    }

    public function test_admin_registration_rejects_passwords_shorter_than_eight_characters(): void
    {
        $this->from(route('register'))->post(route('register'), [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'short7',
            'password_confirmation' => 'short7',
        ])->assertSessionHasErrors('password');
    }

    public function test_admin_can_save_custom_ceremonies_and_bank_settings(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('wedding.update'), [
            'groom_name_kh' => 'ឈ្មោះកូនប្រុស',
            'groom_name_en' => 'Groom Name',
            'bride_name_kh' => 'ឈ្មោះកូនស្រី',
            'bride_name_en' => 'Bride Name',
            'wedding_datetime' => '2027-11-18T07:00',
            'location_name' => 'Siem Reap',
            'primary_color' => '#D4AF37',
            'secondary_color' => '#8B0000',
            'force_background_style' => 'contain',
            'flower_effect_style' => 'jasmine_white',
            'krong_pali_icon' => 'heart',
            'hair_cutting_icon' => 'sun',
            'knot_tying_icon' => 'scissors',
            'evening_reception_icon' => 'glass',
            'enable_aba' => '1',
            'aba_account_name' => 'Wedding Couple',
            'aba_account_usd' => '123456789',
            'aba_account_khr' => '987654321',
            'additional_ceremonies' => [[
                'title_kh' => 'ពិធីបន្ថែម',
                'title_en' => 'Custom Ceremony',
                'time' => '14:00',
                'description' => 'Custom ceremony details',
            ]],
        ])->assertRedirect(route('wedding.edit'));

        $user = $user->fresh();
        $setting = $user->weddingSetting;
        $this->assertSame('jasmine_white', $setting->flower_effect_style);
        $this->assertSame('#D4AF37', $setting->primary_color);
        $this->assertSame('contain', $setting->force_background_style);
        $this->assertSame('heart', $setting->krong_pali_icon);
        $this->assertSame('sun', $setting->hair_cutting_icon);
        $this->assertSame('scissors', $setting->knot_tying_icon);
        $this->assertSame('glass', $setting->evening_reception_icon);
        $this->assertTrue($setting->enable_aba);
        $this->assertFalse($setting->enable_acleda);
        $this->assertSame('123456789', $setting->aba_account_usd);
        $this->assertSame('Custom Ceremony', $setting->additional_ceremonies[0]['title_en']);

        $this->get(route('wedding.show'))
            ->assertOk()
            ->assertSee('ពិធីបន្ថែម')
            ->assertSee('data-flower-style="jasmine_white"', false)
            ->assertSee('2:00 PM')
            ->assertSee('123456789');

        $this->withSession(['locale' => 'en'])
            ->get(route('wedding.show'))
            ->assertOk()
            ->assertSee('Custom Ceremony');
    }

    public function test_admin_can_upload_custom_ceremony_icons(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $pngBytes = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAADUlEQVR4nGP4z8AAAAMBAQDJ/pLvAAAAAElFTkSuQmCC');

        $this->actingAs($user)->post(route('wedding.update'), [
            'groom_name_kh' => 'ឈ្មោះកូនប្រុស',
            'groom_name_en' => 'Groom Name',
            'bride_name_kh' => 'ឈ្មោះកូនស្រី',
            'bride_name_en' => 'Bride Name',
            'wedding_datetime' => '2027-11-18T07:00',
            'location_name' => 'Siem Reap',
            'primary_color' => '#D4AF37',
            'secondary_color' => '#8B0000',
            'force_background_style' => 'contain',
            'flower_effect_style' => 'jasmine_white',
            'krong_pali_icon_image' => UploadedFile::fake()->createWithContent('krong-pali.png', $pngBytes),
            'hair_cutting_icon_image' => UploadedFile::fake()->createWithContent('hair-cutting.png', $pngBytes),
            'knot_tying_icon_image' => UploadedFile::fake()->createWithContent('knot-tying.png', $pngBytes),
            'evening_reception_icon_image' => UploadedFile::fake()->createWithContent('evening-reception.png', $pngBytes),
        ])->assertRedirect(route('wedding.edit'));

        $setting = $user->fresh()->weddingSetting;
        foreach (['krong_pali_icon', 'hair_cutting_icon', 'knot_tying_icon', 'evening_reception_icon'] as $field) {
            $iconPath = $setting->{$field};
            $this->assertStringStartsWith('ceremony_icons/', $iconPath);
            $this->assertTrue(Storage::disk('public')->exists($iconPath));
        }

        $adminForm = $this->actingAs($user)->get(route('wedding.edit'))->assertOk();
        $invitation = $this->get(route('wedding.show'))->assertOk();
        foreach (['krong_pali_icon', 'hair_cutting_icon', 'knot_tying_icon', 'evening_reception_icon'] as $field) {
            $src = asset('storage/' . $setting->{$field});
            $adminForm->assertSee($src, false);
            $invitation->assertSee($src, false);
        }
    }

    public function test_public_invitation_renders_owned_gallery_photos_and_custom_profile(): void
    {
        $user = User::factory()->create();
        $setting = WeddingSetting::query()->create([
            'user_id' => $user->id,
            'groom_name_kh' => 'កូនប្រុស',
            'groom_name_en' => 'Groom Example',
            'bride_name_kh' => 'កូនស្រី',
            'bride_name_en' => 'Bride Example',
            'groom_bio' => 'A custom groom biography.',
        ]);
        $setting->preWeddingPhotos()->create([
            'photo_path' => 'img/gallery/example.jpg',
            'caption' => 'Siem Reap memory',
            'display_order' => 0,
        ]);

        $this->get(route('wedding.show'))
            ->assertOk()
            ->assertSee('Groom Example')
            ->assertSee('A custom groom biography.')
            ->assertSee('Siem Reap memory')
            ->assertSee(asset('img/gallery/example.jpg'), false);
    }
}
