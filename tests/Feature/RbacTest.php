<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RbacTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_cannot_access_admin_create_routes(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);
        $this->actingAs($staff)->get('/categories/create')->assertStatus(403);
        $this->actingAs($staff)->get('/products/create')->assertStatus(403);
    }

    public function test_admin_can_access_admin_create_routes(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->get('/categories/create')->assertStatus(200);
    }

}