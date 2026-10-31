<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin Gudang',
            'email' => 'admin@gudangku.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $staff = User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@gudangku.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        $catElektronik = Category::create(['name' => 'Elektronik', 'description' => 'Barang elektronik']);
        $catATK = Category::create(['name' => 'ATK', 'description' => 'Alat tulis kantor']);
        $catMakanan = Category::create(['name' => 'Makanan', 'description' => 'Produk makanan']);

        $sup1 = Supplier::create(['name' => 'PT Sumber Jaya', 'contact' => '08123456789', 'email' => 'info@sumberjaya.test', 'address' => 'Jakarta']);
        $sup2 = Supplier::create(['name' => 'CV Maju Bersama', 'contact' => '08987654321', 'email' => 'sales@majubersama.test', 'address' => 'Bandung']);

        $p1 = Product::create(['category_id' => $catElektronik->id, 'supplier_id' => $sup1->id, 'name' => 'Keyboard Mechanical', 'sku' => 'ELE-001', 'description' => 'Keyboard mechanical RGB', 'price' => 450000, 'stock' => 10, 'min_stock' => 5]);
        $p2 = Product::create(['category_id' => $catElektronik->id, 'supplier_id' => $sup1->id, 'name' => 'Mouse Wireless', 'sku' => 'ELE-002', 'description' => 'Mouse wireless 2.4G', 'price' => 125000, 'stock' => 3, 'min_stock' => 5]);
        $p3 = Product::create(['category_id' => $catATK->id, 'supplier_id' => $sup2->id, 'name' => 'Kertas A4', 'sku' => 'ATK-001', 'description' => 'Kertas A4 80gsm', 'price' => 45000, 'stock' => 45, 'min_stock' => 10]);
        $p4 = Product::create(['category_id' => $catMakanan->id, 'supplier_id' => $sup2->id, 'name' => 'Kopi Sachet', 'sku' => 'MKN-001', 'description' => 'Kopi instan sachet', 'price' => 2000, 'stock' => 100, 'min_stock' => 20]);

        StockMovement::create(['product_id' => $p1->id, 'user_id' => $admin->id, 'type' => 'in', 'quantity' => 10, 'note' => 'Stok awal']);
        StockMovement::create(['product_id' => $p3->id, 'user_id' => $staff->id, 'type' => 'out', 'quantity' => 5, 'note' => 'Distribusi']);
    }
}