<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class keranjangController extends Controller
{
    // ✅ Tampilkan isi keranjang
    public function index()
    {
        $keranjang = Session::get('keranjang', []);

        $total = array_sum(array_map(function ($item) {
            return $item['harga'] * $item['jumlah'];
        }, $keranjang));

        return view('keranjang.index', compact('keranjang', 'total'));
    }

    // ✅ Tambah item ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'nama'      => 'required|string',
            'harga'     => 'required|numeric',
        ]);

        $keranjang = Session::get('keranjang', []);
        $id = $request->produk_id;

        if (isset($keranjang[$id])) {
            // Jika sudah ada, tambah jumlahnya
            $keranjang[$id]['jumlah'] += 1;
        } else {
            // Jika belum ada, tambah sebagai item baru
            $keranjang[$id] = [
                'nama'   => $request->nama,
                'harga'  => $request->harga,
                'jumlah' => 1,
            ];
        }

        Session::put('keranjang', $keranjang);

        return redirect()->route('keranjang.index')
                         ->with('success', 'Item berhasil ditambahkan ke keranjang!');
    }

    // ✅ Update jumlah item di keranjang
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Session::get('keranjang', []);

        if (!isset($keranjang[$id])) {
            return redirect()->route('keranjang.index')
                             ->with('error', 'Item tidak ditemukan di keranjang!');
        }

        $keranjang[$id]['jumlah'] = $request->jumlah;
        Session::put('keranjang', $keranjang);

        return redirect()->route('keranjang.index')
                         ->with('success', 'Jumlah item berhasil diupdate!');
    }

    // ✅ Hapus item dari keranjang
    public function destroy(string $id)
    {
        $keranjang = Session::get('keranjang', []);

        if (!isset($keranjang[$id])) {
            return redirect()->route('keranjang.index')
                             ->with('error', 'Item tidak ditemukan di keranjang!');
        }

        unset($keranjang[$id]);
        Session::put('keranjang', $keranjang);

        return redirect()->route('keranjang.index')
                         ->with('success', 'Item berhasil dihapus dari keranjang!');
    }
}