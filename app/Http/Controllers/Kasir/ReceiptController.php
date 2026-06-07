<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class ReceiptController extends Controller
{
    public function print(Order $order)
    {
        $order->load(['orderItems.menu', 'user', 'payment']);
        return view('kasir.receipt.print', compact('order'));
    }
}
