@extends('layouts.admin')

@section('title', 'Data Pesanan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Data Pesanan Kue</h1>
    </div>
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg" role="alert">
        <p class="font-bold">Sukses!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            {{-- KODE TABEL BARU YANG SUDAH DIPERBAIKI --}}
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">No</th>
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">ID Pesanan</th>
                        <th class="w-3/12 text-left py-3 px-4 uppercase font-semibold text-sm">Nama Pelanggan</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Tanggal Pesanan</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Kue yang Dipesan</th>
                        <th class="w-2/12 text-left py-3 px-4 uppercase font-semibold text-sm">Total Harga</th>
                        {{-- KOLOM STATUS DITAMBAHKAN KEMBALI --}}
                        <th class="w-1/12 text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        <th class="w-1/12 text-center py-3 px-4 uppercase font-semibold text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($orders as $order)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="text-left py-3 px-4">{{ $loop->iteration + $orders->firstItem() - 1 }}</td>
                        <td class="text-left py-3 px-4">{{ $order->id }}</td>
                        <td class="text-left py-3 px-4 font-medium">{{ $order->user->name }}</td>
                        <td class="text-left py-3 px-4">{{ \Carbon\Carbon::parse($order->tanggal_pemesanan)->format('d M Y') }}</td>
                        <td class="text-left py-3 px-4">{{ $order->cake->nama_kue }}</td>
                        <td class="text-left py-3 px-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        
                        <td class="text-left py-3 px-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($order->status == 'pending') bg-yellow-200 text-yellow-800
                                @elseif($order->status == 'completed') bg-green-200 text-green-800
                                @elseif($order->status == 'cancelled') bg-red-200 text-red-800
                                @else bg-gray-200 text-gray-800
                                @endif
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        <td class="text-center py-3 px-4">
                            <div class="flex justify-center items-center gap-2">
                                @if ($order->status == 'pending')
                                    <form action="{{ route('admin.data-pemesanan.approve', $order->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin approve pesanan ini?');">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold py-2 px-3 rounded-lg transition duration-300">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.data-pemesanan.reject', $order->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin reject pesanan ini?');">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-bold py-2 px-3 rounded-lg transition duration-300">Reject</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.data-pemesanan.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENGHAPUS PERMANEN pesanan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold py-2 px-3 rounded-lg transition duration-300">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        {{-- Sesuaikan colspan menjadi 8 karena jumlah kolom sekarang ada 8 --}}
                        <td colspan="8" class="text-center py-4 text-gray-500">
                            Belum ada pesanan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
