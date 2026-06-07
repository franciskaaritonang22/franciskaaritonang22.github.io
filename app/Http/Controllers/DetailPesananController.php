<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\detail_pesanan;

class detail_pesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request) {
    // Menambah item ke dalam pesanan
    detail_pesanan::create([
        'id_pesanan' => $request->id_pesanan,
        'id_menu' => $request->id_menu,
        'jumlah' => $request->jumlah,
        'subtotal' => $request->harga_satuan * $request->jumlah
    ]);
    return back();
    }
}