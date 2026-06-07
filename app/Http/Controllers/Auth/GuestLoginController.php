<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuestLoginController extends Controller
{
    public function create()
    {
        return view('auth.guest-login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Generate a random email for the guest
        $email = 'guest_' . Str::random(10) . '_' . time() . '@tamu.local';

        // Create the guest user
        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make(Str::random(16)),
            'role' => 'pelanggan',
            'status' => true,
        ]);

        // Log in the guest
        Auth::login($user);

        // Redirect to customer home page
        return redirect()->route('pelanggan.home');
    }
}
