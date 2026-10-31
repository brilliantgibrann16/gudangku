@extends('layouts.app')
@section('title', 'Kategori')
@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Kategori</h1>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Tambah</a>
    @endif
</div>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Deskripsi</th>
                <th class="px-4 py-2 text-left">Jumlah Produk</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $c)
            <tr class="border-t">
                <td class="px-4 py-2 font-medium">{{ $c->name }}</td>
                <td class="px-4 py-2">{{ $c->description ?? '-' }}</td>
                <td class="px-4 py-2">{{ $c->products_count }}</td>
                <td class="px-4 py-2 space-x-2">
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('categories.edit', $c) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('categories.destroy', $c) }}" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                    @else
                    <span class="text-slate-400">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-4 py-4 text-center text-slate-500">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $categories->links() }}</div>
@endsection