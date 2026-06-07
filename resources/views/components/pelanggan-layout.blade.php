<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Menu' }} - MAKECENTS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #112d1e;
        }
        .bg-grid {
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 80px 80px;
        }
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
        .custom-scrollbar-dark::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar-dark::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar-dark::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.2); border-radius: 20px; }

        /* ── MOBILE DRAWER OVERLAY ── */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 998;
            backdrop-filter: blur(2px);
            transition: opacity 0.3s ease;
        }
        .mobile-overlay.open { display: block; }

        /* ── MOBILE DRAWER ── */
        .mobile-drawer {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 260px;
            background: #112d1e;
            z-index: 999;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
            overflow-y: auto;
        }
        .mobile-drawer.open { transform: translateX(0); }

        /* ── MOBILE TOPBAR ── */
        .mobile-topbar {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 56px;
            background: #112d1e;
            z-index: 100;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.3);
        }
        .mobile-topbar-logo {
            font-size: 1.3rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: -0.03em;
            line-height: 1;
        }
        .mobile-topbar-logo span { color: #6fcf97; }
        .mobile-hamburger {
            background: rgba(255,255,255,0.08);
            border: none;
            border-radius: 10px;
            padding: 7px;
            cursor: pointer;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }
        .mobile-hamburger:hover { background: rgba(255,255,255,0.15); }
        .mobile-cart-btn {
            background: rgba(255,255,255,0.08);
            border: none;
            border-radius: 10px;
            padding: 7px 10px;
            cursor: pointer;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s;
            position: relative;
        }
        .mobile-cart-btn:hover { background: rgba(255,255,255,0.15); }
        .mobile-cart-count {
            background: #6fcf97;
            color: #112d1e;
            font-size: 10px;
            font-weight: 800;
            min-width: 18px;
            height: 18px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
        }



        /* ── MOBILE CART PANEL ── */
        .mobile-cart-panel {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            flex-direction: column;
            background: #f5f5f0;
            overflow-y: auto;
        }
        .mobile-cart-panel.open { display: flex; }
        .mobile-cart-panel-header {
            background: #112d1e;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .mobile-cart-close {
            background: rgba(255,255,255,0.12);
            border: none;
            border-radius: 8px;
            padding: 6px;
            cursor: pointer;
            color: #fff;
            display: flex;
        }

        /* ── RESPONSIVE RULES ── */
        @media (max-width: 768px) {
            /* Show mobile elements */
            .mobile-topbar { display: flex; }

            /* Main layout adjustments */
            body { overflow: auto !important; height: auto !important; }
            .main-layout-wrap {
                flex-direction: column !important;
                padding: 0 !important;
                gap: 0 !important;
                height: auto !important;
                min-height: 100vh;
            }

            /* Hide desktop sidebar & cart on mobile */
            .desktop-sidebar { display: none !important; }
            .desktop-cart { display: none !important; }

            /* Main content adjusts for topbar */
            .main-content-panel {
                border-radius: 0 !important;
                margin-top: 56px !important;
                margin-bottom: 0 !important;
                height: auto !important;
                overflow: visible !important;
                flex: none !important;
                min-height: calc(100vh - 56px) !important;
                box-shadow: none !important;
            }
        }

        @media (min-width: 769px) {
            /* Hide mobile elements on desktop */
            .mobile-topbar { display: none !important; }
            .mobile-drawer { display: none !important; }
            .mobile-overlay { display: none !important; }
        }
    </style>
</head>
<body class="bg-[#112d1e] bg-grid text-gray-800 h-screen overflow-hidden">

{{-- ── MOBILE TOPBAR ── --}}
<div class="mobile-topbar" id="mobileTopbar">
    <button class="mobile-hamburger" id="mobileMenuBtn" onclick="toggleMobileDrawer()">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>
    <div class="mobile-topbar-logo">MAKE<span>CENTS</span></div>
    @php $mobileCartQty = array_sum(array_column(session('cart', []), 'qty')); @endphp
    @if($showCartSidebar ?? true)
    <button class="mobile-cart-btn" onclick="toggleMobileCart()">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <span class="mobile-cart-count">{{ $mobileCartQty }}</span>
    </button>
    @else
    <div style="width:40px"></div>
    @endif
</div>

{{-- ── MOBILE OVERLAY ── --}}
<div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileDrawer()"></div>

{{-- ── MOBILE DRAWER ── --}}
<div class="mobile-drawer" id="mobileDrawer">
    {{-- Logo --}}
    <div style="margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid rgba(255,255,255,0.1)">
        <h1 style="font-size:2rem;font-weight:900;color:#fff;line-height:0.85;letter-spacing:-0.03em;">MA<br>KE<br>CEN<span style="display:inline-block;transform:translateY(-2px)">T</span>S</h1>
        <p style="font-size:0.6rem;letter-spacing:0.2em;margin-top:8px;color:rgba(255,255,255,0.6);text-transform:uppercase;">Coffee Space</p>
    </div>
    {{-- Profile --}}
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid rgba(255,255,255,0.1)">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" style="width:44px;height:44px;border-radius:50%;border:2px solid rgba(255,255,255,0.2);object-fit:cover;">
        <div>
            <p style="font-weight:600;font-size:14px;color:#fff;">Hai, {{ explode(' ', auth()->user()->name)[0] }} 👋</p>
            <p style="font-size:11px;color:rgba(255,255,255,0.6);">Selamat datang kembali!</p>
        </div>
    </div>
    {{-- Nav Links --}}
    @php $currentRoute = Route::currentRouteName(); $isGuest = Str::endsWith(auth()->user()->email, '@tamu.local'); @endphp
    <nav style="flex:1;display:flex;flex-direction:column;gap:4px;">
        <a href="{{ route('pelanggan.home') }}" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:14px;font-weight:500;font-size:14px;text-decoration:none;color:{{ $currentRoute == 'pelanggan.home' ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ $currentRoute == 'pelanggan.home' ? 'rgba(255,255,255,0.12)' : 'none' }};transition:background 0.2s;" onclick="closeMobileDrawer()">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16m-7 6h7"/></svg>Menu
        </a>
        @if(!$isGuest)
        <a href="{{ route('pelanggan.rewards') }}" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:14px;font-weight:500;font-size:14px;text-decoration:none;color:{{ $currentRoute == 'pelanggan.rewards' ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ $currentRoute == 'pelanggan.rewards' ? 'rgba(255,255,255,0.12)' : 'none' }};transition:background 0.2s;" onclick="closeMobileDrawer()">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>Hadiah
        </a>
        @endif
        <a href="{{ route('pelanggan.orders.index') }}" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:14px;font-weight:500;font-size:14px;text-decoration:none;color:{{ Str::startsWith($currentRoute,'pelanggan.orders') ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ Str::startsWith($currentRoute,'pelanggan.orders') ? 'rgba(255,255,255,0.12)' : 'none' }};transition:background 0.2s;" onclick="closeMobileDrawer()">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>Pesanan
        </a>
        <a href="{{ route('pelanggan.favorites') }}" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:14px;font-weight:500;font-size:14px;text-decoration:none;color:{{ $currentRoute == 'pelanggan.favorites' ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ $currentRoute == 'pelanggan.favorites' ? 'rgba(255,255,255,0.12)' : 'none' }};transition:background 0.2s;" onclick="closeMobileDrawer()">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>Favorit
        </a>
        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:14px;font-weight:500;font-size:14px;text-decoration:none;color:{{ $currentRoute == 'profile.edit' ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ $currentRoute == 'profile.edit' ? 'rgba(255,255,255,0.12)' : 'none' }};transition:background 0.2s;" onclick="closeMobileDrawer()">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>Profil
        </a>
    </nav>
    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;padding-top:16px;border-top:1px solid rgba(255,255,255,0.1)">
        @csrf
        <button type="submit" style="display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:14px;font-weight:500;font-size:14px;color:rgba(255,255,255,0.7);background:none;border:none;cursor:pointer;width:100%;font-family:inherit;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Keluar
        </button>
    </form>
</div>

{{-- ── MOBILE CART FULL PANEL ── --}}
@if($showCartSidebar ?? true)
@php
    $cart = session('cart', []);
    $total = array_sum(array_column($cart, 'subtotal'));
    $cartCount = array_sum(array_column($cart, 'qty'));
@endphp
<div class="mobile-cart-panel" id="mobileCartPanel">
    <div class="mobile-cart-panel-header">
        <button class="mobile-cart-close" onclick="toggleMobileCart()">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M19 12H5"/><polyline points="12 19 5 12 12 5"/></svg>
        </button>
        <h2 style="font-size:16px;font-weight:700;flex:1;">Pesanan Anda</h2>
        <span style="background:rgba(255,255,255,0.15);color:#fff;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;">{{ $cartCount }} item</span>
    </div>
    <div style="flex:1;padding:20px 16px;display:flex;flex-direction:column;gap:16px;padding-bottom:140px;">
        @forelse($cart as $id => $item)
        <div style="display:flex;align-items:center;gap:12px;background:#fff;border-radius:16px;padding:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
            <div style="width:52px;height:52px;border-radius:12px;overflow:hidden;background:#f0f0ea;flex-shrink:0;">
                @if(isset($item['image']) && $item['image'])
                    <img src="{{ asset('storage/'.$item['image']) }}" style="width:100%;height:100%;object-fit:cover;">
                @else
                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#ccc;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                @endif
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-weight:600;font-size:13px;color:#111;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item['name'] }}</div>
                <div style="font-size:12px;color:#999;margin-top:2px;">Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
            </div>
            <div style="display:flex;align-items:center;gap:8px;background:#f5f5f0;border-radius:10px;padding:4px 10px;">
                <span style="font-weight:700;font-size:13px;color:#111;">×{{ $item['qty'] }}</span>
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:60px 20px;color:#999;">
            <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 12px;display:block;color:#ddd;"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            <p style="font-size:14px;font-weight:500;">Keranjang Anda kosong</p>
        </div>
        @endforelse
    </div>
    <div style="position:fixed;bottom:0;left:0;right:0;background:#fff;padding:16px 20px;border-top:1px solid #f0f0f0;box-shadow:0 -4px 20px rgba(0,0,0,0.08);">
        <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
            <span style="color:#999;font-size:13px;">Total</span>
            <span style="font-weight:700;font-size:16px;color:#111;">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
        <a href="{{ route('pelanggan.cart.index') }}" style="display:block;width:100%;background:#112d1e;color:#fff;text-align:center;font-weight:700;font-size:14px;padding:14px;border-radius:14px;text-decoration:none;">
            Lihat Keranjang Lengkap
        </a>
    </div>
</div>
@endif

{{-- ── MAIN LAYOUT ── --}}
<div class="flex h-screen p-6 gap-6 max-w-[1600px] mx-auto main-layout-wrap">
    {{-- Desktop Left Sidebar --}}
    <div class="w-60 flex-shrink-0 flex flex-col text-white pb-6 pt-2 desktop-sidebar">
        {{-- Logo --}}
        <div class="mb-10 pl-4 relative">
            <h1 class="text-[2.5rem] font-black leading-[0.8] tracking-tighter">
                MA<br>KE<br>CEN<span class="inline-block transform -translate-y-1">T</span>S
            </h1>
            <p class="text-[0.6rem] tracking-[0.2em] mt-3 opacity-80 uppercase">Coffee Space</p>
        </div>

        {{-- Profile --}}
        <div class="flex flex-col items-center gap-2 mb-10 pl-4 items-start">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" class="w-14 h-14 rounded-full border-2 border-white/20 object-cover">
            <div class="mt-2">
                <p class="font-semibold text-sm">Hai, {{ explode(' ', auth()->user()->name)[0] }} 👋</p>
                <p class="text-xs text-white/60">Selamat datang kembali!</p>
            </div>
        </div>

        {{-- Nav Links --}}
        <nav class="flex-1 space-y-1 pl-2 pr-4 overflow-y-auto custom-scrollbar-dark">
            @php 
                $currentRoute = Route::currentRouteName(); 
                $isGuest = Str::endsWith(auth()->user()->email, '@tamu.local');
            @endphp
            <a href="{{ route('pelanggan.home') }}" class="flex items-center gap-4 px-4 py-3.5 {{ $currentRoute == 'pelanggan.home' ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg> 
                Menu
            </a>
            @if(!$isGuest)
            <a href="{{ route('pelanggan.rewards') }}" class="flex items-center gap-4 px-4 py-3.5 {{ $currentRoute == 'pelanggan.rewards' ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                Hadiah
            </a>
            @endif
            <a href="{{ route('pelanggan.orders.index') }}" class="flex items-center gap-4 px-4 py-3.5 {{ Str::startsWith($currentRoute, 'pelanggan.orders') ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Pesanan
            </a>
            <a href="{{ route('pelanggan.favorites') }}" class="flex items-center gap-4 px-4 py-3.5 {{ $currentRoute == 'pelanggan.favorites' ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                Favorit
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 px-4 py-3.5 {{ $currentRoute == 'profile.edit' ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Profil
            </a>
            
            <a href="{{ route('pelanggan.cart.index') }}" class="flex items-center justify-between px-4 py-3.5 mt-2 {{ $currentRoute == 'pelanggan.cart.index' ? 'bg-white/20' : 'bg-white/10 hover:bg-white/20' }} rounded-[1.25rem] font-medium transition-colors group">
                <div class="flex items-center gap-4">
                    <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Keranjang
                </div>
                @php $sidebarCartQty = array_sum(array_column(session('cart', []), 'qty')); @endphp
                <span class="bg-white text-[#112d1e] text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full group-hover:scale-110 transition-transform">{{ $sidebarCartQty }}</span>
            </a>
        </nav>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-4 pl-2 pr-4 shrink-0">
            @csrf
            <button type="submit" class="flex items-center gap-4 px-4 py-3.5 hover:bg-white/5 rounded-[1.25rem] font-medium text-white/80 transition-colors w-full text-left">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Keluar
            </button>
        </form>
    </div>

    {{-- Main Content Panel --}}
    <div class="flex-1 bg-[#FAFAFA] rounded-[2.5rem] flex flex-col overflow-hidden shadow-2xl relative main-content-panel">
        {{ $slot }}
    </div>

    @if($showCartSidebar ?? true)
    @php
        $cart = session('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        $cartCount = array_sum(array_column($cart, 'qty'));
    @endphp
    {{-- Desktop Right Panel (Cart Sidebar) --}}
    <div class="w-[22rem] flex-shrink-0 bg-[#FAFAFA] rounded-[2.5rem] flex flex-col text-gray-800 overflow-hidden shadow-2xl relative ml-2 desktop-cart">
        <div class="p-8 pb-6 flex justify-between items-center">
            <h2 class="text-[1.35rem] font-bold text-gray-900">Pesanan Anda</h2>
            <div class="bg-[#112d1e] text-white font-bold w-7 h-7 rounded-full flex items-center justify-center text-xs shadow-sm">{{ $cartCount }}</div>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar px-8 space-y-5">
            @forelse($cart as $id => $item)
            <div class="flex items-center gap-4">
                <div class="w-[3.5rem] h-[3.5rem] rounded-[1rem] overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200">
                    @if(isset($item['image']) && $item['image'])
                        <img src="{{ asset('storage/'.$item['image']) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0 pr-2">
                    <h4 class="font-semibold text-sm truncate leading-tight text-gray-900">{{ $item['name'] }}</h4>
                    <p class="text-gray-500 text-[0.8rem] mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                </div>
                <div class="flex items-center gap-1.5 border border-gray-300 rounded-[0.5rem] p-1 px-2 shrink-0">
                    <form action="{{ route('pelanggan.cart.add', $id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="qty" value="-1">
                        <button type="button" onclick="alert('Decrease quantity is handled in full cart page')" class="text-gray-400 hover:text-gray-700 pb-0.5 text-lg leading-none cursor-pointer">-</button>
                    </form>
                    <span class="text-xs font-semibold w-3 text-center text-gray-800">{{ $item['qty'] }}</span>
                    <form action="{{ route('pelanggan.cart.add', $id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="qty" value="1">
                        <button type="submit" class="text-gray-400 hover:text-gray-700 pb-0.5 text-lg leading-none">+</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-10 flex flex-col items-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 opacity-40 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <p class="text-gray-400 text-sm font-medium">Keranjang Anda kosong.</p>
            </div>
            @endforelse
        </div>

        <div class="p-8 bg-[#f0f0f0] mt-auto">
            <div class="flex justify-between items-center mb-3 text-gray-500 text-sm font-medium">
                <span>Subtotal</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center mb-6 text-lg font-bold text-gray-900">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            
            <a href="{{ route('pelanggan.cart.index') }}" class="block w-full bg-[#112d1e] text-white text-center font-bold py-3.5 rounded-[1rem] text-sm hover:bg-[#1a4a30] transition-colors shadow-sm">
                Lihat Keranjang
            </a>
            
            @if(!$isGuest)
            <div class="mt-6 bg-[#112d1e] rounded-[1.25rem] p-4 flex gap-4 items-center relative overflow-hidden shadow-inner">
                <div class="flex-1 z-10 pl-1">
                    <h4 class="font-bold text-sm mb-1 leading-tight tracking-tight text-white">Bawa tumbler,<br>diskon 2rb!</h4>
                    <p class="text-white/70 text-[0.65rem] mb-3 leading-tight">Mari peduli lingkungan bersama.</p>
                    <button class="bg-white text-[#112d1e] text-xs font-bold px-4 py-1.5 rounded-lg hover:bg-gray-100 transition-colors shadow-sm">Pelajari</button>
                </div>
                <div class="w-14 z-10 flex items-center justify-center">
                    <div class="w-10 h-14 bg-gradient-to-b from-gray-300 to-gray-500 rounded-b-md rounded-t-sm relative border-b-4 border-[#112d1e]/20">
                        <div class="absolute -top-1.5 left-1 right-1 h-1.5 bg-gray-400 rounded-t-md"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-[0.4rem] font-bold text-white/80 tracking-widest uppercase origin-center -rotate-90 block">Makecents</span>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-6 -bottom-6 w-28 h-28 bg-white/5 rounded-full z-0 blur-xl"></div>
                <div class="absolute -left-6 -top-6 w-20 h-20 bg-black/10 rounded-full z-0 blur-lg"></div>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>



<script>
    function toggleMobileDrawer() {
        document.getElementById('mobileDrawer').classList.toggle('open');
        document.getElementById('mobileOverlay').classList.toggle('open');
        document.body.style.overflow = document.getElementById('mobileDrawer').classList.contains('open') ? 'hidden' : '';
    }
    function closeMobileDrawer() {
        document.getElementById('mobileDrawer').classList.remove('open');
        document.getElementById('mobileOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }
    function toggleMobileCart() {
        const panel = document.getElementById('mobileCartPanel');
        if (panel) {
            panel.classList.toggle('open');
            document.body.style.overflow = panel.classList.contains('open') ? 'hidden' : '';
        }
    }
</script>

</body>
</html>
