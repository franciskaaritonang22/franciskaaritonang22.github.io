<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function confirm(Request $request, Order $order)
    {
        if (!$order->payment || $order->payment->status === 'paid') {
            return redirect()->back()->withErrors('Pesanan belum memiliki data pembayaran atau sudah dikonfirmasi.');
        }

        $method = $order->payment->method;

        // Validasi berdasarkan metode pembayaran
        if ($method === 'cash') {
            $request->validate([
                'jumlah_bayar' => 'required|numeric|min:' . $order->total_price,
            ], [
                'jumlah_bayar.required' => 'Jumlah bayar harus diisi.',
                'jumlah_bayar.numeric'  => 'Jumlah bayar harus berupa angka.',
                'jumlah_bayar.min'      => 'Jumlah bayar tidak boleh kurang dari total pesanan (Rp ' . number_format($order->total_price, 0, ',', '.') . ').',
            ]);

            $order->payment->update([
                'status'       => 'paid',
                'paid_at'      => now(),
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            $kembalian = $request->jumlah_bayar - $order->total_price;
            $order->update(['status' => 'selesai']);

            if ($order->user && $order->user->role === 'pelanggan') {
                $order->user->increment('points', floor($order->total_price / 1000));
            }

            return redirect()->back()->with('success', 'Pembayaran cash berhasil! Kembalian: Rp ' . number_format($kembalian, 0, ',', '.'));

        } elseif ($method === 'qris') {
            // QRIS: kasir verifikasi bukti bayar yang sudah diupload pelanggan
            if (!$order->payment->bukti_bayar) {
                return redirect()->back()->withErrors('Pelanggan belum mengupload bukti bayar QRIS.');
            }

            $order->payment->update([
                'status'  => 'paid',
                'paid_at' => now(),
            ]);

            $order->update(['status' => 'selesai']);

            if ($order->user && $order->user->role === 'pelanggan') {
                $order->user->increment('points', floor($order->total_price / 1000));
            }

            return redirect()->back()->with('success', 'Pembayaran QRIS berhasil dikonfirmasi!');

        } elseif ($method === 'debit') {
            // Debit: kasir konfirmasi setelah EDC memproses
            $order->payment->update([
                'status'  => 'paid',
                'paid_at' => now(),
            ]);

            $order->update(['status' => 'selesai']);

            if ($order->user && $order->user->role === 'pelanggan') {
                $order->user->increment('points', floor($order->total_price / 1000));
            }

            return redirect()->back()->with('success', 'Pembayaran debit berhasil dikonfirmasi!');
        }

        return redirect()->back()->withErrors('Metode pembayaran tidak dikenali.');
    }
}
