<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Promo;
use Carbon\Carbon;


class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        return view('pelanggan.cart', compact('cart', 'total'));
    }

    public function add(Request $request, Menu $menu)
    {
        $cart = session()->get('cart', []);
        $qty = $request->input('qty', 1);

        if(isset($cart[$menu->id])) {
            $cart[$menu->id]['qty'] += $qty;
            $cart[$menu->id]['subtotal'] = $cart[$menu->id]['qty'] * $cart[$menu->id]['price'];
        } else {
            $cart[$menu->id] = [
                'name' => $menu->name,
                'qty' => $qty,
                'price' => $menu->price,
                'image' => $menu->image,
                'subtotal' => $menu->price * $qty
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('pelanggan.cart.index')->with('success', 'Menu dihapus dari keranjang.');
    }

    public function applyPromo(Request $request)
    {
        $code = $request->input('promo_code');
        $promo = Promo::where('code', $code)
                      ->where('is_active', true)
                      ->first();

        if (!$promo) {
            return back()->with('error', 'Kode promo tidak valid.');
        }

        if ($promo->expires_at && Carbon::parse($promo->expires_at)->isPast()) {
            return back()->with('error', 'Kode promo sudah kedaluwarsa.');
        }

        session()->put('promo', [
            'code' => $promo->code,
            'discount' => $promo->discount,
            'type' => $promo->type
        ]);

        return back()->with('success', 'Kode promo berhasil digunakan!');
    }

    public function removePromo()
    {
        session()->forget('promo');
        return back()->with('success', 'Kode promo dihapus.');
    }
}
