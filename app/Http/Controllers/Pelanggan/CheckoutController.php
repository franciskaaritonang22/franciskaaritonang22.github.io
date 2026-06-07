<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('pelanggan.cart.index')->withErrors('Keranjang Anda kosong.');
        }

        $totalPrice = array_sum(array_column($cart, 'subtotal'));

        $order = Order::create([
            'user_id' => auth()->id(),
            'kode_order' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $request->input('payment_method', 'cash'),
        ]);

        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $id,
                'qty' => $details['qty'],
                'price' => $details['price']
            ]);
        }

        // Otomatis buat Payment record dengan status unpaid (belum bayar)
        Payment::create([
            'order_id' => $order->id,
            'method'   => $request->input('payment_method', 'cash'),
            'status'   => 'unpaid',
        ]);

        session()->forget('cart');

        return redirect()->route('pelanggan.orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran ke kasir.');
    }
}
