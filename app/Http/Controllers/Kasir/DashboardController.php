<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'diproses')->count();
        $unpaidOrders = Order::whereHas('payment', function ($q) {
            $q->where('status', 'unpaid');
        })->count();
        
        $orders = Order::with(['user', 'payment'])->whereIn('status', ['pending', 'diproses'])->latest()->get();

        return view('kasir.dashboard', compact('pendingOrders', 'processingOrders', 'unpaidOrders', 'orders'));
    }
}
