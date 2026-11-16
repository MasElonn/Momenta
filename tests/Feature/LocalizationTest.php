<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocalizationTest extends TestCase
{
    public function test_can_switch_locale_to_english(): void
    {
        $response = $this->get(route('lang.switch', ['locale' => 'en']));

        $response->assertSessionHas('locale', 'en');
        $response->assertRedirect();
    }

    public function test_can_switch_locale_to_indonesian(): void
    {
        $response = $this->get(route('lang.switch', ['locale' => 'id']));

        $response->assertSessionHas('locale', 'id');
        $response->assertRedirect();
    }

    public function test_invalid_locale_is_ignored(): void
    {
        $response = $this->withSession(['locale' => 'id'])
            ->get(route('lang.switch', ['locale' => 'fr']));

        $response->assertSessionHas('locale', 'id');
    }

    public function test_middleware_applies_locale_from_session(): void
    {
        $responseEn = $this->withSession(['locale' => 'en'])->get('/login');
        $this->assertSame('en', app()->getLocale());
        $this->assertSame('Home', __('Home'));
        $responseEn->assertSee('Welcome Back!');
        $responseEn->assertSee('Sign in with Google');

        $responseId = $this->withSession(['locale' => 'id'])->get('/login');
        $this->assertSame('id', app()->getLocale());
        $this->assertSame('Beranda', __('Home'));
        $responseId->assertSee('Selamat Datang Kembali!');
        $responseId->assertSee('Masuk dengan Google');
    }
}
