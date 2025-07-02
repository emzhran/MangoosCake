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

        try {
            $order = Order::create([
                'user_id' => Auth::id(), // Pastikan Auth::id() mengembalikan nilai, tidak null
                'cake_id' => $request->cake_id,
                'jumlah_pemesanan' => $request->quantity,
                'total_price' => $totalPrice,
                'tanggal_pemesanan' => now(),
                'status' => 'pending',
                'catatan' => null, // Jika catatan bisa kosong, pastikan ada nilai default atau boleh NULL di DB
            ]);

            // === DEBUG POINT 3: Apakah order berhasil disimpan ke DB? ===
            // dd('DEBUG 3: Order berhasil dibuat di database.', $order);

        } catch (\Exception $e) {
            // === DEBUG POINT 4: Jika ada error saat menyimpan ke DB ===
            // dd('DEBUG 4: Error saat menyimpan order:', $e->getMessage(), 'Line:', $e->getLine(), 'File:', $e->getFile());
            return redirect()->back()->withErrors(['order_failed' => 'Gagal membuat pesanan: ' . $e->getMessage()])->withInput();
        }

        // === DEBUG POINT 5: Apakah baris redirect ini tercapai? ===
        // dd('DEBUG 5: Akan mengalihkan ke konfirmasi pesanan.', $order->id);

        return redirect()->route('customer.order.confirmation', ['orderId' => $order->id])
                         ->with('success', 'Pesanan Anda berhasil dibuat!');
    }

     public function showOrderConfirmation($orderId)
    {
        // Debugging: Cek apakah metode ini tercapai dan ID order diterima
        // dd('Mencapai showOrderConfirmation dengan ID:', $orderId);

        // Ambil data pesanan beserta relasi kue
        // Pastikan Anda telah mendefinisikan relasi 'cake' di model Order Anda.
        $order = Order::with('cake')->findOrFail($orderId);

        // Verifikasi bahwa pesanan ini milik user yang sedang login (penting untuk keamanan)
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('customer.dashboard')->withErrors(['unauthorized' => 'Anda tidak memiliki akses ke pesanan ini.']);
        }

        return view('customer.order.confirmation', compact('order'));
    }

    /**
     * Menampilkan daftar semua pesanan pelanggan (opsional).
     */
    public function index()
    {
        $orders = Auth::user()->orders()->with('cake')->latest()->get(); // Asumsi ada relasi 'orders' di model User
        return view('customer.orders.index', compact('orders')); // Contoh view untuk daftar pesanan
    }
}