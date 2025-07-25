<?php

namespace Tests\Feature\Auth;

use App\Models\Akun;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $akun = Akun::factory()->create();

        $response = $this->post('/login', [
            'email' => $akun->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $akun = Akun::factory()->create();

        $this->post('/login', [
            'email' => $akun->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $akun = Akun::factory()->create();

        $response = $this->actingAs($akun)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
