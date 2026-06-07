<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pesanan = Pesanan::with(['pelanggan', 'statusPesanan'])->get();
        return view('pesanan.index', compact('pesanan'));
    }

    public function store(Request $request) {
    // Logika simpan pesanan baru
        $pesanan = Pesanan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_status' => 1, // Default: Pending
            'total_harga' => 0, // Akan diupdate setelah detail pesanan diisi
            'tanggal' => now(),
        ]);

    return redirect()->route('detail-pesanan.create', ['id_pesanan' => $pesanan->id]);
    }
}