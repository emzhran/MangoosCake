<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Import model Order
use App\Models\Cake;  // Import model Cake
use Carbon\Carbon;     // Import Carbon untuk bekerja dengan tanggal
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung Total Semua Pesanan
        $totalOrders = Order::count();

        // 2. Menghitung Pendapatan Bulan Ini (hanya dari pesanan 'completed')
        $monthlyRevenue = Order::where('status', 'completed')
                               ->whereMonth('created_at', Carbon::now()->month)
                               ->whereYear('created_at', Carbon::now()->year)
                               ->sum('total_price');

        // 3. Menghitung Jumlah Produk Kue
        $totalCakes = Cake::count();

        // 4. Kirim semua data yang sudah dihitung ke view
        return view('admin.dashboardAdmin', compact(
            'totalOrders', 
            'monthlyRevenue', 
            'totalCakes'
        ));
    }
}