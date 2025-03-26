<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_admin_only_route()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/api/admin-only');
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Admin']);
    }

    public function test_mahasiswa_cannot_access_admin_only_route()
    {
        $mahasiswa = User::factory()->create(['role' => 'mahasiswa']);

        $response = $this->actingAs($mahasiswa)->get('/api/admin-only');
        $response->assertStatus(403)
                 ->assertJson(['message' => 'Tidak memiliki akses.']);
    }

    public function test_dosen_can_access_dosen_or_admin_route()
    {
        $dosen = User::factory()->create(['role' => 'dosen']);

        $response = $this->actingAs($dosen)->get('/api/dosen-or-admin');
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Dosen']);
    }

    public function test_mahasiswa_cannot_access_dosen_or_admin_route()
    {
        $mahasiswa = User::factory()->create(['role' => 'mahasiswa']);

        $response = $this->actingAs($mahasiswa)->get('/api/dosen-or-admin');
        $response->assertStatus(403)
                 ->assertJson(['message' => 'Tidak memiliki akses.']);
    }
}
