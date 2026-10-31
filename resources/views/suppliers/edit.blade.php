@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Edit Supplier</h1>
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $supplier->name) }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kontak</label>
            <input type="text" name="contact" value="{{ old('contact', $supplier->contact) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $supplier->email) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Alamat</label>
            <textarea name="address" rows="3" class="w-full border rounded px-3 py-2">{{ old('address', $supplier->address) }}</textarea>
        </div>
        <div class="flex gap-2">
            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Update</button>
            <a href="{{ route('suppliers.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection