<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with(['product', 'user'])->latest()->paginate(15);
        return view('stock_movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock_movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:in,out'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            if ($data['type'] === 'out' && $product->stock < $data['quantity']) {
                abort(422, 'Stok tidak mencukupi.');
            }

            if ($data['type'] === 'in') {
                $product->increment('stock', $data['quantity']);
            } else {
                $product->decrement('stock', $data['quantity']);
            }

            StockMovement::create([
                'product_id' => $data['product_id'],
                'user_id' => Auth::id(),
                'type' => $data['type'],
                'quantity' => $data['quantity'],
                'note' => $data['note'] ?? null,
            ]);
        });

        return redirect()->route('stock_movements.index')->with('success', 'Pergerakan stok berhasil dicatat.');
    }

    public function destroy(StockMovement $stockMovement)
    {
        // Revert stock on delete
        DB::transaction(function () use ($stockMovement) {
            $product = Product::lockForUpdate()->findOrFail($stockMovement->product_id);
            if ($stockMovement->type === 'in') {
                if ($product->stock < $stockMovement->quantity) {
                    abort(422, 'Stok tidak mencukupi untuk membatalkan pergerakan ini.');
                }
                $product->decrement('stock', $stockMovement->quantity);
            } else {
                $product->increment('stock', $stockMovement->quantity);
            }
            $stockMovement->delete();
        });

        return redirect()->route('stock_movements.index')->with('success', 'Pergerakan stok dibatalkan dan stok dikembalikan.');
    }
}