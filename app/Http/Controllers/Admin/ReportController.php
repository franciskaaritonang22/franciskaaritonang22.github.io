<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();
        
        $totalOrders = $orders->count();
        $completedOrders = $orders->where('status', 'selesai');
        $totalRevenue = $completedOrders->sum('total_price');
        $avgOrderValue = $completedOrders->count() > 0 ? $totalRevenue / $completedOrders->count() : 0;
        $pendingCount = $orders->whereIn('status', ['pending', 'diproses'])->count();

        return view('admin.reports.index', compact('orders', 'totalRevenue', 'totalOrders', 'avgOrderValue', 'pendingCount'));
    }

    public function exportPdf(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();
        
        $totalOrders = $orders->count();
        $completedOrders = $orders->where('status', 'selesai');
        $totalRevenue = $completedOrders->sum('total_price');
        $avgOrderValue = $completedOrders->count() > 0 ? $totalRevenue / $completedOrders->count() : 0;
        $pendingCount = $orders->whereIn('status', ['pending', 'diproses'])->count();

        $pdf = Pdf::loadView('admin.reports.pdf', compact('orders', 'totalRevenue', 'totalOrders', 'avgOrderValue', 'pendingCount', 'request'));
        
        // return $pdf->stream('laporan-penjualan.pdf'); // You can use stream for preview or download for direct download
        return $pdf->download('laporan-penjualan-' . date('Y-m-d') . '.pdf');
    }
}
