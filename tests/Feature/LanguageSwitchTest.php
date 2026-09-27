<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LanguageSwitchTest extends TestCase
{
    use RefreshDatabase;

    public function test_language_switch_stores_the_locale_and_redirects_back(): void
    {
        $this->from('/admin/settings')
            ->get(route('lang.switch', ['locale' => 'en']))
            ->assertRedirect('/admin/settings')
            ->assertSessionHas('locale', 'en');
    }

    public function test_unsupported_locales_are_rejected(): void
    {
        $this->get('/lang/fr')->assertNotFound();
    }

    public function test_locale_middleware_uses_khmer_by_default_and_session_locale_when_set(): void
    {
        $this->get(route('wedding.show'))
            ->assertOk()
            ->assertSee(__('messages.nav_home', [], 'kh'));

        $this->withSession(['locale' => 'en'])
            ->get(route('wedding.show'))
            ->assertOk()
            ->assertSee(__('messages.nav_home', [], 'en'));
    }
}
