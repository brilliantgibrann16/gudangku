<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
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

    public function test_staff_can_record_but_cannot_delete_stock_movement(): void
    {
        $staff = User::factory()->create(['role' => 'staff']);
        $category = Category::create(['name' => 'Test']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Test Product',
            'sku' => 'RBAC-001',
            'price' => 100,
            'stock' => 0,
            'min_stock' => 1,
        ]);
        $movement = StockMovement::create([
            'product_id' => $product->id,
            'user_id' => $staff->id,
            'type' => 'in',
            'quantity' => 1,
        ]);

        $this->actingAs($staff)->delete(route('stock_movements.destroy', $movement))->assertStatus(403);
        $this->assertDatabaseHas('stock_movements', ['id' => $movement->id]);
    }
}
