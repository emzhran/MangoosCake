<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Cake;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['user', 'cake'])->latest()->paginate(10);
        return view('admin.datapesanan', compact('orders')); 
    }
      
    public function show(Order $order): View
    {
        $order->load(['user', 'cake']);
        return view('admin.pesanan_detail', compact('order'));
    }

    public function edit(Order $order): View
    {
        return view('admin.pesanan_edit', compact('order')); 
    }
    
    public function update(Request $request, Order $order): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.data-pemesanan.index')->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()->route('admin.data-pemesanan.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
