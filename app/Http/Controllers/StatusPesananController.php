<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status_pesanan;

class Status_PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $status = Status_Pesanan::all();
        return view('status_pesanan.index', compact('status'));
    }
}