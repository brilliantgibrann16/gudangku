@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded shadow">
        <p class="text-slate-500 text-sm">Total Produk</p>
        <p class="text-3xl font-bold">{{ $totalProducts }}</p>
    </div>
    <div class="bg-white p-5 rounded shadow">
        <p class="text-slate-500 text-sm">Produk Stok Rendah</p>
        <p class="text-3xl font-bold text-red-600">{{ $lowStock }}</p>
    </div>
    <div class="bg-white p-5 rounded shadow">
        <p class="text-slate-500 text-sm">Total Pergerakan Stok</p>
        <p class="text-3xl font-bold">{{ $totalMovements }}</p>
    </div>
</div>

<h2 class="text-lg font-semibold mb-2">Pergerakan Stok Terbaru</h2>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Produk</th>
                <th class="px-4 py-2 text-left">Tipe</th>
                <th class="px-4 py-2 text-left">Jumlah</th>
                <th class="px-4 py-2 text-left">User</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentMovements as $m)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-2">{{ $m->product->name ?? '-' }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs {{ $m->type === 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $m->type === 'in' ? 'Masuk' : 'Keluar' }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $m->quantity }}</td>
                <td class="px-4 py-2">{{ $m->user->name ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-4 text-center text-slate-500">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection