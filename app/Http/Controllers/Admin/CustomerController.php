<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'pelanggan')->latest()->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function update(Request $request, User $customer)
    {
        $request->validate([
            'status' => 'required|boolean'
        ]);

        $customer->update(['status' => $request->status]);

        return redirect()->route('admin.customers.index')->with('success', 'Status pelanggan berhasil diperbarui.');
    }
}
