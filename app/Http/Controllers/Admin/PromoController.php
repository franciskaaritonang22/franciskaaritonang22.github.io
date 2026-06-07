<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:promos,code',
            'discount' => 'required|numeric',
            'type' => 'required|in:fixed,percentage',
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date'
        ]);

        Promo::create($request->all());

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'code' => 'required|unique:promos,code,' . $promo->id,
            'discount' => 'required|numeric',
            'type' => 'required|in:fixed,percentage',
            'is_active' => 'boolean',
            'expires_at' => 'nullable|date'
        ]);

        $promo->update($request->all());

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil dihapus');
    }

    public function toggleStatus(Promo $promo)
    {
        $promo->update(['is_active' => !$promo->is_active]);
        return back()->with('success', 'Status promo berhasil diubah');
    }
}
