@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Login</h1>
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember" class="text-sm">Ingat saya</label>
        </div>
        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Masuk</button>
    </form>
    <p class="mt-4 text-sm text-center">Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600">Daftar</a></p>
</div>
@endsection