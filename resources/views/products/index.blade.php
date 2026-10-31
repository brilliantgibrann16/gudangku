@extends('layouts.app')
@section('title', 'Produk')
@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Produk</h1>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Tambah</a>
    @endif
</div>
<form method="GET" class="mb-4 flex gap-2">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/SKU" class="border rounded px-3 py-2">
    <select name="category_id" class="border rounded px-3 py-2">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $c)
        <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
    </select>
    <button class="bg-slate-200 px-4 py-2 rounded">Filter</button>
</form>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left">SKU</th>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Kategori</th>
                <th class="px-4 py-2 text-left">Supplier</th>
                <th class="px-4 py-2 text-left">Harga</th>
                <th class="px-4 py-2 text-left">Stok</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $p)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $p->sku }}</td>
                <td class="px-4 py-2 font-medium">{{ $p->name }}</td>
                <td class="px-4 py-2">{{ $p->category->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $p->supplier->name ?? '-' }}</td>
                <td class="px-4 py-2">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                <td class="px-4 py-2">
                    <span class="{{ $p->isLowStock() ? 'text-red-600 font-bold' : '' }}">{{ $p->stock }}</span>
                    <span class="text-slate-400 text-xs">/min {{ $p->min_stock }}</span>
                </td>
                <td class="px-4 py-2 space-x-2">
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('products.edit', $p) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('products.destroy', $p) }}" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                    @else
                    <span class="text-slate-400">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-4 py-4 text-center text-slate-500">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection