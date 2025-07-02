{{-- Menggunakan layout utama dari layouts/admin.blade.php --}}
@extends('layouts.admin')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Dashboard Admin')

{{-- Ini adalah bagian konten yang akan dimasukkan ke dalam @yield('content') di layout utama --}}
@section('content')
    <h1 class="text-3xl font-bold text-gray-800">Selamat Datang di Dasbor Admin</h1>
    <p class="mt-2 text-gray-600">Ini adalah area khusus untuk administrator Mangoo's Kue.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        {{-- Kartu Total Pesanan --}}
        <div class="bg-white p-6 rounded-xl shadow-md border border-red-200">
            <h3 class="text-lg font-semibold text-gray-700">Total Pesanan</h3>
            <p class="text-4xl font-bold text-[#960000] mt-2">{{ $totalOrders }}</p>
        </div>
        
        {{-- Kartu Pendapatan --}}
        <div class="bg-white p-6 rounded-xl shadow-md border border-red-200">
            <h3 class="text-lg font-semibold text-gray-700">Pendapatan Bulan Ini</h3>
            <p class="text-4xl font-bold text-[#960000] mt-2">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
        </div>
        
        {{-- Kartu Produk --}}
        <div class="bg-white p-6 rounded-xl shadow-md border border-red-200">
            <h3 class="text-lg font-semibold text-gray-700">Produk Kue</h3>
            <p class="text-4xl font-bold text-[#960000] mt-2">{{ $totalCakes }}</p>
        </div>
    </div>
@endsection