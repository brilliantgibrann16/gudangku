<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStock = Product::whereColumn('stock', '<=', 'min_stock')->count();
        $totalMovements = StockMovement::count();
        $recentMovements = StockMovement::with(['product', 'user'])->latest()->take(10)->get();

        return view('dashboard.index', compact('totalProducts', 'lowStock', 'totalMovements', 'recentMovements'));
    }
}