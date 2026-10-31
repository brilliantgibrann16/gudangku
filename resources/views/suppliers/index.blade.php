@extends('layouts.app')
@section('title', 'Supplier')
@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Supplier</h1>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('suppliers.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Tambah</a>
    @endif
</div>
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Kontak</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Alamat</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $s)
            <tr class="border-t">
                <td class="px-4 py-2 font-medium">{{ $s->name }}</td>
                <td class="px-4 py-2">{{ $s->contact ?? '-' }}</td>
                <td class="px-4 py-2">{{ $s->email ?? '-' }}</td>
                <td class="px-4 py-2">{{ $s->address ?? '-' }}</td>
                <td class="px-4 py-2 space-x-2">
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('suppliers.edit', $s) }}" class="text-indigo-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('suppliers.destroy', $s) }}" class="inline" onsubmit="return confirm('Hapus supplier ini?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                    @else
                    <span class="text-slate-400">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-4 text-center text-slate-500">Belum ada supplier.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $suppliers->links() }}</div>
@endsection