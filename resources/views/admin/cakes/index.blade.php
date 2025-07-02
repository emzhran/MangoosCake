@extends('layouts.admin')

@section('title', 'Data Kue')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Data Kue</h1>
        {{-- Tombol ini mengarah ke halaman 'create' --}}
        <a href="{{ route('admin.datakue.create') }}" class="bg-[#960000] hover:bg-[#800000] text-white font-bold py-2 px-4 rounded-lg transition duration-300">
    + Tambah Kue
</a>
    </div>

    {{-- Komponen untuk menampilkan notifikasi sukses setelah create, update, atau delete --}}
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p class="font-bold">Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Gambar</th>
                        <th class="w-4/12 text-left py-3 px-4 uppercase font-semibold text-sm">Nama Kue</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Harga</th>
                        <th class="w-3/12 text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    {{-- Looping untuk setiap data kue yang dikirim dari controller --}}
                    @forelse ($cakes as $cake)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="text-left py-3 px-4">{{ $loop->iteration + $cakes->firstItem() - 1 }}</td>
                        <td class="text-left py-3 px-4">
                            {{-- Menampilkan gambar dari storage --}}
                            <img src="{{ asset('storage/' . $cake->gambar_kue) }}" alt="{{ $cake->nama_kue }}" class="h-16 w-16 object-cover rounded-md">
                        </td>
                        <td class="text-left py-3 px-4 font-medium">{{ $cake->nama_kue }}</td>
                        <td class="text-left py-3 px-4">Rp {{ number_format($cake->harga_kue, 0, ',', '.') }}</td>
                        <td class="text-center py-3 px-4">
                            {{-- Tombol Edit mengarah ke halaman 'edit' dengan membawa ID kue --}}
                            <a href="{{ route('admin.datakue.edit', $cake->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold py-2 px-3 rounded-lg transition duration-300">Edit</a>
                            
                            {{-- Tombol Hapus ada di dalam form untuk keamanan --}}
                            <form action="{{ route('admin.datakue.destroy', $cake->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kue ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold py-2 px-3 rounded-lg transition duration-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    {{-- Tampilan jika tidak ada data kue sama sekali --}}
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Belum ada data kue. Silakan tambahkan kue baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Menampilkan link paginasi --}}
        <div class="p-4">
            {{ $cakes->links() }}
        </div>
    </div>
@endsection
