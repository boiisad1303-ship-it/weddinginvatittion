<?php

namespace App\Http\Controllers;

use App\Models\WeddingSetting;
use App\Models\Wish;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;

class WeddingController extends Controller
{
    public function index(): View
    {
        $settings = WeddingSetting::query()->with('preWeddingPhotos')->first();
        return $this->invitationView($settings);
    }

    public function showPublic(string $slug): View
    {
        $settings = WeddingSetting::query()
            ->with('preWeddingPhotos')
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->invitationView($settings);
    }

    private function invitationView(?WeddingSetting $settings): View
    {
        $wishes = Wish::query()->latest()->limit(50)->get();
        $ceremonies = collect([
            ['title_kh' => 'ពិធីក្រុងពាលី', 'title_en' => 'Krong Pali Ceremony', 'time' => $settings?->krong_pali_time, 'description' => $settings?->krong_pali_desc, 'icon' => $settings?->krong_pali_icon ?: 'sun'],
            ['title_kh' => 'ពិធីកាត់សក់បង្កក់សិរី', 'title_en' => 'Hair Cutting Ceremony', 'time' => $settings?->hair_cutting_time, 'description' => $settings?->hair_cutting_desc, 'icon' => $settings?->hair_cutting_icon ?: 'scissors'],
            ['title_kh' => 'ពិធីចងដៃ និងសំពះផ្ទឹម', 'title_en' => 'Knot Tying Ceremony', 'time' => $settings?->knot_tying_time, 'description' => $settings?->knot_tying_desc, 'icon' => $settings?->knot_tying_icon ?: 'heart'],
            ['title_kh' => 'ពិធីលៀងសាយភោជន', 'title_en' => 'Evening Reception', 'time' => $settings?->evening_reception_time, 'description' => $settings?->evening_reception_desc, 'icon' => $settings?->evening_reception_icon ?: 'glass'],
        ])->filter(fn(array $ceremony) => filled($ceremony['time']) || filled($ceremony['description']))
            ->concat(collect($settings?->additional_ceremonies ?? [])->map(fn(array $ceremony) => $ceremony + ['icon' => 'fa-star']))
            ->values();

        return view('wedding', [
            'settings' => $settings,
            'wishes' => $wishes,
            'photos' => $settings?->preWeddingPhotos ?? collect(),
            'ceremonies' => $ceremonies,
            'weddingDate' => $settings?->wedding_datetime?->toIso8601String(),
        ]);
    }

    public function editForm(Request $request): View
    {
        return view('admin.form', [
            'settings' => $request->user()->weddingSetting,
            'photos' => $request->user()->weddingSetting?->preWeddingPhotos ?? collect(),
        ]);
    }

    public function updateForm(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'groom_name_kh' => ['required', 'string', 'max:255'],
            'groom_name_en' => ['required', 'string', 'max:255'],
            'groom_bio_text' => ['nullable', 'string', 'max:3000'],
            'bride_name_kh' => ['required', 'string', 'max:255'],
            'bride_name_en' => ['required', 'string', 'max:255'],
            'bride_bio_text' => ['nullable', 'string', 'max:3000'],
            'wedding_date_kh' => ['nullable', 'string', 'max:255'],
            'wedding_datetime' => ['required', 'date'],
            'location_name' => ['required', 'string', 'max:255'],
            'location_map_url' => ['nullable', 'url', 'max:2048'],
            'krong_pali_time' => ['nullable', 'date_format:H:i'],
            'krong_pali_desc' => ['nullable', 'string', 'max:2000'],
            'hair_cutting_time' => ['nullable', 'date_format:H:i'],
            'hair_cutting_desc' => ['nullable', 'string', 'max:2000'],
            'knot_tying_time' => ['nullable', 'date_format:H:i'],
            'knot_tying_desc' => ['nullable', 'string', 'max:2000'],
            'evening_reception_time' => ['nullable', 'date_format:H:i'],
            'evening_reception_desc' => ['nullable', 'string', 'max:2000'],
            'krong_pali_icon' => ['nullable', Rule::in(['sun', 'scissors', 'heart', 'glass'])],
            'hair_cutting_icon' => ['nullable', Rule::in(['sun', 'scissors', 'heart', 'glass'])],
            'knot_tying_icon' => ['nullable', Rule::in(['sun', 'scissors', 'heart', 'glass'])],
            'evening_reception_icon' => ['nullable', Rule::in(['sun', 'scissors', 'heart', 'glass'])],
            'krong_pali_icon_image' => ['nullable', 'file', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'hair_cutting_icon_image' => ['nullable', 'file', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'knot_tying_icon_image' => ['nullable', 'file', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'evening_reception_icon_image' => ['nullable', 'file', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'additional_ceremonies' => ['nullable', 'array', 'max:12'],
            'additional_ceremonies.*.title_kh' => ['required', 'string', 'max:255'],
            'additional_ceremonies.*.title_en' => ['nullable', 'string', 'max:255'],
            'additional_ceremonies.*.time' => ['nullable', 'date_format:H:i'],
            'additional_ceremonies.*.description' => ['nullable', 'string', 'max:2000'],
            'flower_effect_style' => ['required', Rule::in(['rumdul_gold', 'jasmine_white', 'rose_petal', 'lotus_petal', 'sparkle_gold'])],
            'primary_color' => ['required', 'regex:/^#[A-Fa-f0-9]{6}$/'],
            'secondary_color' => ['required', 'regex:/^#[A-Fa-f0-9]{6}$/'],
            'force_background_style' => ['required', Rule::in(['cover', 'contain', 'repeat', 'fixed_blur'])],
            'enable_aba' => ['sometimes', 'boolean'],
            'aba_account_usd' => ['nullable', 'string', 'max:100'],
            'aba_account_khr' => ['nullable', 'string', 'max:100'],
            'aba_account_name' => ['nullable', 'string', 'max:255'],
            'enable_acleda' => ['sometimes', 'boolean'],
            'acleda_account_usd' => ['nullable', 'string', 'max:100'],
            'acleda_account_khr' => ['nullable', 'string', 'max:100'],
            'acleda_account_name' => ['nullable', 'string', 'max:255'],
            'enable_wing' => ['sometimes', 'boolean'],
            'wing_account_usd' => ['nullable', 'string', 'max:100'],
            'wing_account_khr' => ['nullable', 'string', 'max:100'],
            'wing_account_name' => ['nullable', 'string', 'max:255'],
            'groom_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'bride_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'wedding_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120'],
            'background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'qr_code_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'background_audio_file' => ['nullable', 'file', 'mimes:mp3', 'max:8192'],
            'pre_wedding_photos' => ['nullable', 'array', 'max:30'],
            'pre_wedding_photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'photo_captions' => ['nullable', 'array'],
            'photo_captions.*' => ['nullable', 'string', 'max:255'],
            'delete_photos' => ['nullable', 'array'],
            'delete_photos.*' => ['integer'],
            'photo_order' => ['nullable', 'array'],
            'photo_order.*' => ['integer'],
        ]);

        $user = $request->user();
        $setting = $user->weddingSetting ?? new WeddingSetting();
        $oldFiles = [];
        $uploadDirectories = [
            'groom_photo' => 'img/profiles',
            'bride_photo' => 'img/profiles',
            'wedding_logo' => 'img/logos',
            'background_image' => 'img/bg',
            'qr_code_image' => 'img/qr',
            'background_audio_file' => 'audio',
        ];

        foreach ($uploadDirectories as $field => $directory) {
            if ($request->hasFile($field)) {
                $oldFiles[] = $setting->{$field};
                $validated[$field] = $this->storePublicUpload($request->file($field), $directory);
            }
        }

        $validated['enable_aba'] = $request->boolean('enable_aba');
        $validated['enable_acleda'] = $request->boolean('enable_acleda');
        $validated['enable_wing'] = $request->boolean('enable_wing');
        foreach (
            [
                'krong_pali_icon' => 'sun',
                'hair_cutting_icon' => 'scissors',
                'knot_tying_icon' => 'heart',
                'evening_reception_icon' => 'glass',
            ] as $field => $defaultIcon
        ) {
            $validated[$field] = $validated[$field] ?? $defaultIcon;
        }
        $this->storeCeremonyIconUploads($request, $setting, $validated, $oldFiles);
        $validated['additional_ceremonies'] = collect($validated['additional_ceremonies'] ?? [])
            ->filter(fn(array $ceremony) => filled($ceremony['title_kh'] ?? null))
            ->values()
            ->all();

        $deleteIds = $validated['delete_photos'] ?? [];
        $orderedIds = $validated['photo_order'] ?? [];
        $newPhotos = $request->file('pre_wedding_photos', []);
        $captions = $validated['photo_captions'] ?? [];
        unset($validated['delete_photos'], $validated['photo_order'], $validated['pre_wedding_photos'], $validated['photo_captions']);

        $setting->fill($validated);
        $setting->user()->associate($user);
        $setting->save();

        if ($deleteIds !== []) {
            $photosToDelete = $setting->preWeddingPhotos()->whereIn('id', $deleteIds)->get();
            foreach ($photosToDelete as $photo) {
                $this->deleteManagedFile($photo->photo_path);
                $photo->delete();
            }
        }

        foreach (array_values($orderedIds) as $order => $photoId) {
            $setting->preWeddingPhotos()->whereKey($photoId)->update(['display_order' => $order]);
        }

        $nextOrder = (int) $setting->preWeddingPhotos()->max('display_order') + 1;
        foreach ($newPhotos as $index => $photoFile) {
            $setting->preWeddingPhotos()->create([
                'photo_path' => $this->storePublicUpload($photoFile, 'img/gallery'),
                'caption' => $captions[$index] ?? null,
                'display_order' => $nextOrder + $index,
            ]);
        }

        foreach ($oldFiles as $oldFile) {
            $this->deleteManagedFile($oldFile);
        }

        return redirect()->route('wedding.edit')->with('status', __('messages.saved'));
    }

    private function storePublicUpload(UploadedFile $file, string $directory): string
    {
        File::ensureDirectoryExists(public_path($directory));
        $filename = bin2hex(random_bytes(20)) . '.' . $file->extension();
        $file->move(public_path($directory), $filename);

        return $directory . '/' . $filename;
    }

    private function storeCeremonyIconUploads(Request $request, WeddingSetting $setting, array &$validated, array &$oldFiles): void
    {
        foreach (['krong_pali_icon', 'hair_cutting_icon', 'knot_tying_icon', 'evening_reception_icon'] as $field) {
            $imageField = $field . '_image';
            if ($request->hasFile($imageField)) {
                $oldFiles[] = $setting->{$field};
                $validated[$field] = $request->file($imageField)->store('ceremony_icons', 'public');
            } elseif (str_starts_with((string) $setting->{$field}, 'ceremony_icons/')) {
                $validated[$field] = $setting->{$field};
            }
            unset($validated[$imageField]);
        }
    }

    private function deleteManagedFile(?string $path): void
    {
        if ($path && str_starts_with($path, 'ceremony_icons/')) {
            Storage::disk('public')->delete($path);

            return;
        }

        if ($path && preg_match('#^(img/(profiles|logos|qr|gallery|bg)/|audio/)#', $path)) {
            File::delete(public_path($path));
        }
    }
}
