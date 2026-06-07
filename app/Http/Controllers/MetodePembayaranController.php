<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metode_pembayaran;

class Metode_PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $metode = Metode_Pembayaran::all();
        return view('metode_pembayaran.index', compact('metode'));
    }
}
