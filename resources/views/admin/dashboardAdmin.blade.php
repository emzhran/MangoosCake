{{-- Menggunakan layout utama dari layouts/admin.blade.php --}}
@extends('layouts.admin')

{{-- Mengatur judul spesifik untuk halaman ini --}}
@section('title', 'Dashboard Admin')

{{-- Ini adalah bagian konten yang akan dimasukkan ke dalam @yield('content') di layout utama --}}
@section('content')
    <h1 class="text-3xl font-bold text-gray-800">Selamat Datang di Dasbor Admin</h1>
    <p class="mt-2 text-gray-600">Ini adalah area khusus untuk administrator Mangoo's Kue.</p>

    <!-- Contoh Kartu Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <div class="bg-white p-6 rounded-xl shadow-md border border-orange-100">
            <h3 class="text-lg font-semibold text-gray-700">Total Pesanan</h3>
            <p class="text-4xl font-bold text-yellow-500 mt-2">1,250</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-orange-100">
            <h3 class="text-lg font-semibold text-gray-700">Pendapatan Bulan Ini</h3>
            <p class="text-4xl font-bold text-yellow-500 mt-2">Rp 8.75Jt</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border border-orange-100">
            <h3 class="text-lg font-semibold text-gray-700">Produk Kue</h3>
            <p class="text-4xl font-bold text-yellow-500 mt-2">25</p>
        </div>
    </div>
@endsection
