<?php
namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment'])->latest();
        
        if ($request->has('status') && in_array($request->status, ['pending', 'diproses', 'selesai', 'dibatalkan'])) {
            $query->where('status', $request->status);
        }
        
        $orders = $query->get();
        return view('kasir.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['orderItems.menu', 'user', 'payment']);
        return view('kasir.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
