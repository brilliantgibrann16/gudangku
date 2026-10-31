<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GudangKu') - Sistem Manajemen Inventaris Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="font-bold text-lg text-indigo-600">GudangKu</a>
            @auth
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                <a href="{{ route('categories.index') }}" class="hover:text-indigo-600">Kategori</a>
                <a href="{{ route('suppliers.index') }}" class="hover:text-indigo-600">Supplier</a>
                <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Produk</a>
                <a href="{{ route('stock_movements.index') }}" class="hover:text-indigo-600">Stok</a>
                <span class="text-slate-500">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button class="text-red-600 hover:underline">Logout</button>
                </form>
            </div>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-6">
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-200">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 border border-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>