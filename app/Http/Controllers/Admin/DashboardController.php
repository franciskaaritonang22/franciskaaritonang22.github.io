<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Menu;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'selesai')->sum('total_price');
        $totalMenus = Menu::count();
        $totalCustomers = User::where('role', 'pelanggan')->count();

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'totalMenus', 'totalCustomers', 'recentOrders'));
    }
}
