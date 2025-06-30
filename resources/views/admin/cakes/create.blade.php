@extends('layouts.admin')

@section('title', 'Tambah Kue Baru')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tambah Kue Baru</h1>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
        {{-- Form ini akan mengirim data ke method 'store' di CakeController --}}
        <form action="{{ route('admin.datakue.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama Kue -->
            <div class="mb-4">
                <label for="nama_kue" class="block text-gray-700 text-sm font-bold mb-2">Nama Kue</label>
                <input type="text" id="nama_kue" name="nama_kue" value="{{ old('nama_kue') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_kue') border-red-500 @enderror" required>
                @error('nama_kue')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga Kue -->
            <div class="mb-4">
                <label for="harga_kue" class="block text-gray-700 text-sm font-bold mb-2">Harga</label>
                <input type="number" id="harga_kue" name="harga_kue" value="{{ old('harga_kue') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('harga_kue') border-red-500 @enderror" required>
                @error('harga_kue')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar Kue -->
            <div class="mb-6">
                <label for="gambar_kue" class="block text-gray-700 text-sm font-bold mb-2">Gambar Kue</label>
                <input type="file" id="gambar_kue" name="gambar_kue" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none @error('gambar_kue') border-red-500 @enderror" required>
                <p class="mt-1 text-sm text-gray-500">Tipe file: JPG, PNG (Maks. 2MB).</p>
                @error('gambar_kue')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <a href="{{ route('admin.datakue.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg mr-2 transition duration-300">Batal</a>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Simpan Kue</button>
            </div>
        </form>
    </div>
@endsection
