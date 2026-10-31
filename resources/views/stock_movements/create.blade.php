@extends('layouts.app')
@section('title', 'Catat Stok')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Catat Pergerakan Stok</h1>
    <form method="POST" action="{{ route('stock_movements.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Produk</label>
            <select name="product_id" required class="w-full border rounded px-3 py-2">
                <option value="">Pilih produk</option>
                @foreach ($products as $p)
                <option value="{{ $p->id }}" {{ old('product_id') == $p->id ? 'selected' : '' }}>{{ $p->name }} (stok: {{ $p->stock }})</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Tipe</label>
            <select name="type" required class="w-full border rounded px-3 py-2">
                <option value="in" {{ old('type') === 'in' ? 'selected' : '' }}>Masuk (In)</option>
                <option value="out" {{ old('type') === 'out' ? 'selected' : '' }}>Keluar (Out)</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Jumlah</label>
            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Catatan</label>
            <input type="text" name="note" value="{{ old('note') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex gap-2">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Simpan</button>
            <a href="{{ route('stock_movements.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection