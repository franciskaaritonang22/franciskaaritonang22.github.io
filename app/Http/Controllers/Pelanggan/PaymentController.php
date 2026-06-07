<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;


class PaymentController extends Controller
{
    /**
     * Upload bukti bayar untuk pembayaran QRIS
     */
    public function uploadBukti(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);

        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'bukti_bayar.required' => 'Bukti bayar wajib diupload.',
            'bukti_bayar.image'    => 'File harus berupa gambar.',
            'bukti_bayar.mimes'    => 'Format gambar harus JPG atau PNG.',
            'bukti_bayar.max'      => 'Ukuran file maksimal 2MB.',
        ]);

        if (!$order->payment || $order->payment->status === 'paid') {
            return redirect()->back()->withErrors('Pembayaran tidak valid atau sudah dikonfirmasi.');
        }

        // Simpan file bukti bayar
        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        $order->payment->update([
            'bukti_bayar' => $path,
        ]);

        return redirect()->back()->with('success', 'Bukti bayar berhasil diupload! Menunggu konfirmasi kasir.');
    }

    /**
     * Mengubah metode pembayaran
     */
    public function changeMethod(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);

        if ($order->payment && $order->payment->status === 'paid') {
            return redirect()->back()->withErrors('Pesanan sudah dibayar, tidak dapat mengubah metode pembayaran.');
        }

        $request->validate([
            'payment_method' => 'required|in:cash,qris,debit',
        ]);

        $order->update([
            'payment_method' => $request->payment_method
        ]);

        if ($order->payment) {
            $order->payment->update([
                'method' => $request->payment_method,
                'bukti_bayar' => null // Reset bukti bayar jika mereka mengubah metode
            ]);
        } else {
            Payment::create([
                'order_id' => $order->id,
                'method' => $request->payment_method,
                'status' => 'unpaid'
            ]);
        }

        return redirect()->back()->with('success', 'Metode pembayaran berhasil diubah.');
    }
}
