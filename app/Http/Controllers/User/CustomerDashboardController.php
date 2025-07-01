<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cake;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {
         $cakes = Cake::all();
        return view('customer.dashboardCustomer', compact('cakes'));
    }
}