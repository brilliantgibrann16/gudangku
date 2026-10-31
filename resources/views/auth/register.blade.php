@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Register</h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2">
        </div>
        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Daftar</button>
    </form>
    <p class="mt-4 text-sm text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600">Login</a></p>
</div>
@endsection