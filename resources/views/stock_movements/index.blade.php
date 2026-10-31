@extends('layouts.app')
@section('title', 'Pergerakan Stok')
@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Pergerakan Stok</h1>
    <a href="{{ route('stock_movements.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Catat</a>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Produk</th>
                <th class="px-4 py-2 text-left">Tipe</th>
                <th class="px-4 py-2 text-left">Jumlah</th>
                <th class="px-4 py-2 text-left">Catatan</th>
                <th class="px-4 py-2 text-left">User</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movements as $m)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                <td class="px-4 py-2">{{ $m->product->name ?? '-' }}</td>
                <td class="px-4 py-2">
                    <span class="px-2 py-1 rounded text-xs {{ $m->type === 'in' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $m->type === 'in' ? 'Masuk' : 'Keluar' }}
                    </span>
                </td>
                <td class="px-4 py-2">{{ $m->quantity }}</td>
                <td class="px-4 py-2">{{ $m->note ?? '-' }}</td>
                <td class="px-4 py-2">{{ $m->user->name ?? '-' }}</td>
                <td class="px-4 py-2">
                    <form method="POST" action="{{ route('stock_movements.destroy', $m) }}" class="inline" onsubmit="return confirm('Batalkan pergerakan ini? Stok akan dikembalikan.')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Batalkan</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-4 py-4 text-center text-slate-500">Belum ada pergerakan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $movements->links() }}</div>
@endsection