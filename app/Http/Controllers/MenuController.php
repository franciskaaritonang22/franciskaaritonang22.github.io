<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $menus = Menu::with('kategori')->get();
        return view('menu.index', compact('menus'));
    }

    public function create() {
        $kategori = Kategori::all();
        return view('menu.create', compact('kategori'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_menu' => 'required',
            'id_kategori' => 'required',
            'harga' => 'required|numeric'
        ]);

    Menu::create($request->all());
    return redirect()->route('menu.index');
    }
}