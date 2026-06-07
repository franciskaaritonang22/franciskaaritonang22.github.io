<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pesanan;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request) {
        $request->validate([
            'id_pesanan' => 'required',
            'id_metode' => 'required',
            'total_bayar' => $request->total_bayar,
            'tanggal_bayar' => now()
        ]);
    
    Pembayaran::create($request->all());
    
    // Update status pesanan menjadi 'Lunas' (misal ID status lunas adalah 3)
    $pesanan = Pesanan::find($request->id_pesanan);
    $pesanan->update(['id_status' => 3]);

    return redirect()->route('pesanan.index')->with('success', 'Pembayaran Berhasil');
    }
}