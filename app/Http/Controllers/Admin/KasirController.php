<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    public function index()
    {
        $kasirs = User::where('role', 'kasir')->latest()->get();
        return view('admin.kasirs.index', compact('kasirs'));
    }

    public function update(Request $request, User $kasir)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $kasir->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $kasir->update($data);

        return redirect()->route('admin.kasirs.index')->with('success', 'Kasir berhasil diperbarui.');
    }

    public function toggleStatus(User $kasir)
    {
        $kasir->update(['status' => !$kasir->status]);
        return redirect()->route('admin.kasirs.index')->with('success', 'Status kasir berhasil diubah.');
    }
}
