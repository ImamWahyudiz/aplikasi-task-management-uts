<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $this->get('/sanctum/csrf-cookie'); // penting untuk login/register
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'mahasiswa',
        ]);

        $response->assertStatus(200); // default Laravel register return 200
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_user_can_login_and_get_profile()
    {
        $this->withoutExceptionHandling(); // untuk debug

        $user = User::factory()->create([
            'email' => 'login@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Simulasi login sebagai user (bukan hanya actingAs)
        $response = $this->actingAs($user)->getJson('/api/user');

        $response->assertStatus(200);
        $response->assertJsonFragment(['email' => 'login@example.com']);
    }
}
