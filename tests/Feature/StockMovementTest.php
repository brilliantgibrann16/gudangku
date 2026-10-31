<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockMovementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_stock_in_increments_stock(): void
    {
        $user = $this->admin();
        $cat = Category::create(['name' => 'Cat']);
        $p = Product::create(['category_id' => $cat->id, 'name' => 'Prod', 'sku' => 'SKU1', 'price' => 10, 'stock' => 5, 'min_stock' => 2]);

        $this->actingAs($user)->post('/stock_movements', [
            'product_id' => $p->id,
            'type' => 'in',
            'quantity' => 3,
        ])->assertRedirect(route('stock_movements.index'));

        $this->assertEquals(8, $p->fresh()->stock);
    }

    public function test_stock_out_rejected_when_insufficient(): void
    {
        $user = $this->admin();
        $cat = Category::create(['name' => 'Cat']);
        $p = Product::create(['category_id' => $cat->id, 'name' => 'Prod', 'sku' => 'SKU2', 'price' => 10, 'stock' => 2, 'min_stock' => 2]);

        $this->actingAs($user)->post('/stock_movements', [
            'product_id' => $p->id,
            'type' => 'out',
            'quantity' => 5,
        ])->assertStatus(422);

        $this->assertEquals(2, $p->fresh()->stock);
    }
}