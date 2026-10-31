@extends('layouts.app')
@section('title', 'Edit Produk')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Edit Produk</h1>
    <form method="POST" action="{{ route('products.update', $product) }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <select name="category_id" required class="w-full border rounded px-3 py-2">
                @foreach ($categories as $c)
                <option value="{{ $c->id }}" {{ old('category_id', $product->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Supplier</label>
            <select name="supplier_id" class="w-full border rounded px-3 py-2">
                <option value="">-</option>
                @foreach ($suppliers as $s)
                <option value="{{ $s->id }}" {{ old('supplier_id', $product->supplier_id) == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">SKU</label>
            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="description" rows="2" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div>
                <label class="block text-sm font-medium mb-1">Harga</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stok (read-only, ubah via pergerakan stok)</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" readonly class="w-full border rounded px-3 py-2 bg-slate-100 cursor-not-allowed">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Min Stok</label>
                <input type="number" name="min_stock" value="{{ old('min_stock', $product->min_stock) }}" required class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="flex gap-2">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection