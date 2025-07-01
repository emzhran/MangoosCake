<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cake; // Jangan lupa import model Cake
use Illuminate\Http\Request;

use App\Models\Order; // Import model Order
use Illuminate\Support\Facades\Auth; // Import Auth

class CustomerOrderController extends Controller
{
    /**
     * Menampilkan halaman form untuk memesan kue.
     */
    public function create(Cake $cake)
    {
        // Route-Model Binding ($cake) secara otomatis akan mengambil data kue
        // berdasarkan ID yang ada di URL.

        // Tampilkan view form order dan kirim data kue yang dipilih
        return view('customer.order.create', compact('cake'));
    }

    // Kita akan tambahkan method store() nanti di Langkah 5
    public function store(Request $request)
    {
        $request->validate([
            'cake_id' => 'required|exists:cakes,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cake = Cake::find($request->cake_id);
        $totalPrice = $cake->harga_kue * $request->quantity;

        // Simpan pesanan ke database
        Order::create([
            'user_id' => auth()->id(),
            'cake_id' => $request->cake_id,
            'jumlah_pemesanan' => $request->quantity, // DIUBAH agar sesuai dengan model
            'total_price' => $totalPrice,
            'tanggal_pemesanan' => now(), // DITAMBAHKAN, mengambil waktu saat ini
            'status' => 'pending',
            // 'catatan' bisa dikosongkan jika di database boleh NULL
        ]);

        // Arahkan ke halaman "pesanan saya" atau dashboard dengan pesan sukses
        return redirect()->route('customer.dashboard')->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }
}