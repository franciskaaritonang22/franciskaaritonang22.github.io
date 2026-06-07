<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Menu::where('status', 'tersedia');
        
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $menus = $query->latest()->get();

        return view('pelanggan.home', compact('menus', 'categories'));
    }
}
