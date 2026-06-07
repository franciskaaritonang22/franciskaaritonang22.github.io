<nav x-data="{ open: false }" style="
    width: 220px;
    flex-shrink: 0;
    background: #112d1e;
    padding: 32px 18px;
    display: flex;
    flex-direction: column;
    gap: 4px;
    position: sticky;
    top: 0;
    height: 100vh;
    font-family: 'DM Sans', 'Segoe UI', sans-serif;
" id="desktopNav">

    <style>
        .nav-brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 28px;
        }
        .nav-brand-wordmark {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
        }
        .nav-brand-line {
            color: #ffffff;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 4px;
            line-height: 1.15;
            text-align: center;
        }
        .nav-brand-sub {
            color: #a8c5b5;
            font-size: 9px;
            letter-spacing: 4px;
            text-transform: uppercase;
            margin-top: 6px;
            text-align: center;
        }

        .nav-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .nav-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 2.5px solid rgba(255,255,255,0.2);
            background: #2a6b4a;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            font-size: 18px;
            font-weight: 700;
            color: #fff;
        }
        .nav-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .nav-profile-name {
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
        }
        .nav-profile-sub {
            color: #a8c5b5;
            font-size: 11px;
            margin-top: -4px;
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 12px;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s ease, color 0.2s ease, transform 0.15s ease;
            position: relative;
            background: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            width: 100%;
            text-align: left;
        }
        .nav-item svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.8;
            transition: opacity 0.2s;
        }
        .nav-item:hover {
            background: rgba(111, 207, 151, 0.15);
            color: #6fcf97;
            transform: translateX(3px);
        }
        .nav-item:hover svg { opacity: 1; }
        .nav-item.nav-active {
            background: rgba(255,255,255,0.15);
            color: #ffffff;
            font-weight: 600;
        }
        .nav-item.nav-active svg { opacity: 1; }
        .nav-item.nav-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            bottom: 25%;
            width: 3px;
            background: #6fcf97;
            border-radius: 0 3px 3px 0;
        }
        .nav-badge {
            background: #6fcf97;
            color: #112d1e;
            font-size: 10px;
            font-weight: 800;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
        }
        .nav-logout-wrap {
            margin-top: auto;
            padding-top: 8px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        /* Dropdown */
        .nav-dropdown-wrap {
            position: relative;
        }
        .nav-dropdown-menu {
            position: absolute;
            bottom: calc(100% + 6px);
            left: 14px;
            right: 14px;
            background: #1f4a33;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
            z-index: 100;
        }
        .nav-dropdown-item {
            display: block;
            padding: 10px 14px;
            color: rgba(255,255,255,0.75);
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }
        .nav-dropdown-item:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        /* ── MOBILE OVERLAY ── */
        .nav-mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 997;
            backdrop-filter: blur(2px);
        }
        .nav-mobile-overlay.open { display: block; }

        /* ── MOBILE DRAWER (sidebar sliding from left) ── */
        .nav-mobile-drawer {
            display: none;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: 240px;
            background: #112d1e;
            z-index: 998;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
            flex-direction: column;
            padding: 24px 16px;
            overflow-y: auto;
            gap: 4px;
            font-family: 'DM Sans', 'Segoe UI', sans-serif;
        }
        .nav-mobile-drawer.open { transform: translateX(0); }

        /* ── MOBILE TOPBAR ── */
        .nav-mobile-topbar {
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
        .nav-mobile-topbar-logo {
            font-family: 'DM Sans', 'Segoe UI', sans-serif;
            font-size: 1.2rem;
            font-weight: 900;
            color: #fff;
            letter-spacing: -0.02em;
        }
        .nav-mobile-topbar-logo span { color: #6fcf97; }
        .nav-mob-hamburger {
            background: rgba(255,255,255,0.08);
            border: none;
            border-radius: 10px;
            padding: 7px;
            cursor: pointer;
            color: #fff;
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            /* Hide desktop sidebar, show mobile topbar */
            #desktopNav { display: none !important; }
            .nav-mobile-topbar { display: flex !important; }
            .nav-mobile-drawer { display: flex; }
        }
        @media (min-width: 769px) {
            .nav-mobile-topbar { display: none !important; }
            .nav-mobile-drawer { display: none !important; }
            .nav-mobile-overlay { display: none !important; }
        }
    </style>

    {{-- ── Brand ── --}}
    <div class="nav-brand">
        <div class="nav-brand-wordmark">
            <div style="display:flex;flex-direction:column;align-items:flex-end">
                <span class="nav-brand-line">MA</span>
                <span class="nav-brand-line">KE</span>
            </div>
            <div style="color:#6fcf97;display:flex;align-items:center;justify-content:center;padding:0 3px">
                <svg viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:18px;height:22px">
                    <path d="M10 2 C10 2 4 7 4 13 A6 6 0 0 0 16 13 C16 7 10 2 10 2Z" fill="#6fcf97"/>
                    <line x1="10" y1="13" x2="10" y2="22" stroke="#6fcf97" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="6" y1="18" x2="14" y2="18" stroke="#6fcf97" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div style="display:flex;flex-direction:column;align-items:flex-start">
                <span class="nav-brand-line">CEN</span>
                <span class="nav-brand-line">TS</span>
            </div>
        </div>
        <div class="nav-brand-sub">Coffee Space</div>
    </div>

    {{-- ── Profile ── --}}
    <div class="nav-profile">
        <div class="nav-avatar">
            @auth
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/'.Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                @endif
            @endauth
        </div>
        <div class="nav-profile-name">Hi, {{ Auth::user()->name ?? 'Guest' }} 👋</div>
        <div class="nav-profile-sub">Welcome back!</div>
    </div>

    {{-- ── Navigation Links ── --}}
    <div class="nav-links">

        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-item {{ request()->routeIs('admin.categories.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
                </svg>
                Categories
            </a>
            <a href="{{ route('admin.menus.index') }}"
               class="nav-item {{ request()->routeIs('admin.menus.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8h1a4 4 0 010 8h-1"/>
                    <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                </svg>
                Menus
            </a>
            <a href="{{ route('admin.customers.index') }}"
               class="nav-item {{ request()->routeIs('admin.customers.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
                Customers
            </a>
            <a href="{{ route('admin.reports.index') }}"
               class="nav-item {{ request()->routeIs('admin.reports.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"/>
                    <line x1="12" y1="20" x2="12" y2="4"/>
                    <line x1="6" y1="20" x2="6" y2="14"/>
                </svg>
                Reports
            </a>

        @elseif(Auth::user()->role === 'kasir')
            <a href="{{ route('kasir.dashboard') }}"
               class="nav-item {{ request()->routeIs('kasir.dashboard') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('kasir.orders.index') }}"
               class="nav-item {{ request()->routeIs('kasir.orders.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <line x1="9" y1="12" x2="15" y2="12"/>
                    <line x1="9" y1="16" x2="13" y2="16"/>
                </svg>
                Orders
            </a>

        @elseif(Auth::user()->role === 'pelanggan')
            <a href="{{ route('pelanggan.home') }}"
               class="nav-item {{ request()->routeIs('pelanggan.home') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18M3 12h18M3 18h18"/>
                    <circle cx="7" cy="6" r="1" fill="currentColor"/>
                    <circle cx="7" cy="12" r="1" fill="currentColor"/>
                    <circle cx="7" cy="18" r="1" fill="currentColor"/>
                </svg>
                Menu
            </a>
            <a href="{{ route('pelanggan.cart.index') }}"
               class="nav-item {{ request()->routeIs('pelanggan.cart.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Keranjang
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="nav-badge">{{ $cartCount }}</span>
                @endif
            </a>
            <a href="{{ route('pelanggan.orders.index') }}"
               class="nav-item {{ request()->routeIs('pelanggan.orders.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <line x1="9" y1="12" x2="15" y2="12"/>
                    <line x1="9" y1="16" x2="13" y2="16"/>
                </svg>
                Pesanan Saya
            </a>
        @endif

    </div>

    {{-- ── Profile Dropdown + Logout ── --}}
    <div class="nav-logout-wrap">
        <div class="nav-dropdown-wrap" x-data="{ dropOpen: false }">
            <button @click="dropOpen = !dropOpen" class="nav-item" style="width:100%">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                {{ Auth::user()->name }}
                <svg x-bind:style="dropOpen ? 'transform:rotate(180deg)' : ''" style="width:12px;height:12px;margin-left:auto;transition:transform 0.2s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </button>

            <div x-show="dropOpen" x-transition class="nav-dropdown-menu" style="display:none">
                <a href="{{ route('profile.edit') }}" class="nav-dropdown-item">
                    ✏️ &nbsp;Edit Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-dropdown-item" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;font-family:inherit">
                        🚪 &nbsp;Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>

</nav>

{{-- ── MOBILE TOPBAR ── --}}
<div class="nav-mobile-topbar" id="navMobileTopbar">
    <button class="nav-mob-hamburger" id="navHamburger" onclick="toggleNavDrawer()">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>
    <div class="nav-mobile-topbar-logo">MAKE<span>CENTS</span></div>
    <div style="width:34px"></div>{{-- spacer for centering --}}
</div>

{{-- ── MOBILE OVERLAY ── --}}
<div class="nav-mobile-overlay" id="navMobileOverlay" onclick="closeNavDrawer()"></div>

{{-- ── MOBILE DRAWER ── --}}
<div class="nav-mobile-drawer" id="navMobileDrawer">
    {{-- Brand --}}
    <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,0.1)">
        <div class="nav-brand-wordmark" style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;margin-bottom:6px;">
            <div style="display:flex;flex-direction:column;align-items:flex-end">
                <span class="nav-brand-line">MA</span>
                <span class="nav-brand-line">KE</span>
            </div>
            <div style="color:#6fcf97;display:flex;align-items:center;justify-content:center;padding:0 3px">
                <svg viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:16px;height:20px">
                    <path d="M10 2 C10 2 4 7 4 13 A6 6 0 0 0 16 13 C16 7 10 2 10 2Z" fill="#6fcf97"/>
                    <line x1="10" y1="13" x2="10" y2="22" stroke="#6fcf97" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="6" y1="18" x2="14" y2="18" stroke="#6fcf97" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div style="display:flex;flex-direction:column;align-items:flex-start">
                <span class="nav-brand-line">CEN</span>
                <span class="nav-brand-line">TS</span>
            </div>
        </div>
        <div class="nav-brand-sub">Coffee Space</div>
    </div>

    {{-- Profile --}}
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,0.1)">
        <div class="nav-avatar" style="width:40px;height:40px;font-size:14px;flex-shrink:0;">
            @auth
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/'.Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                @endif
            @endauth
        </div>
        <div>
            <div class="nav-profile-name" style="text-align:left;">Hi, {{ Auth::user()->name ?? 'Guest' }} 👋</div>
            <div class="nav-profile-sub">Welcome back!</div>
        </div>
    </div>

    {{-- Nav Links --}}
    <div style="display:flex;flex-direction:column;gap:2px;flex:1;">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('admin.categories.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/>
                </svg>
                Categories
            </a>
            <a href="{{ route('admin.menus.index') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('admin.menus.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8h1a4 4 0 010 8h-1"/>
                    <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                </svg>
                Menus
            </a>
            <a href="{{ route('admin.customers.index') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('admin.customers.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path d="M16 3.13a4 4 0 010 7.75"/>
                </svg>
                Customers
            </a>
            <a href="{{ route('admin.reports.index') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('admin.reports.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"/>
                    <line x1="12" y1="20" x2="12" y2="4"/>
                    <line x1="6" y1="20" x2="6" y2="14"/>
                </svg>
                Reports
            </a>

        @elseif(Auth::user()->role === 'kasir')
            <a href="{{ route('kasir.dashboard') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('kasir.dashboard') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('kasir.orders.index') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('kasir.orders.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <line x1="9" y1="12" x2="15" y2="12"/>
                    <line x1="9" y1="16" x2="13" y2="16"/>
                </svg>
                Orders
            </a>

        @elseif(Auth::user()->role === 'pelanggan')
            <a href="{{ route('pelanggan.home') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('pelanggan.home') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18M3 12h18M3 18h18"/>
                    <circle cx="7" cy="6" r="1" fill="currentColor"/>
                    <circle cx="7" cy="12" r="1" fill="currentColor"/>
                    <circle cx="7" cy="18" r="1" fill="currentColor"/>
                </svg>
                Menu
            </a>
            <a href="{{ route('pelanggan.cart.index') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('pelanggan.cart.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Keranjang
                @php $cartCount2 = count(session('cart', [])); @endphp
                @if($cartCount2 > 0)
                    <span class="nav-badge">{{ $cartCount2 }}</span>
                @endif
            </a>
            <a href="{{ route('pelanggan.orders.index') }}" onclick="closeNavDrawer()"
               class="nav-item {{ request()->routeIs('pelanggan.orders.*') ? 'nav-active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <line x1="9" y1="12" x2="15" y2="12"/>
                    <line x1="9" y1="16" x2="13" y2="16"/>
                </svg>
                Pesanan Saya
            </a>
        @endif
    </div>

    {{-- Profile Dropdown + Logout --}}
    <div style="margin-top:auto;padding-top:12px;border-top:1px solid rgba(255,255,255,0.08);">
        <a href="{{ route('profile.edit') }}" onclick="closeNavDrawer()" class="nav-item" style="text-decoration:none;display:flex;margin-bottom:4px;">
            ✏️ &nbsp;Edit Profile
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-item" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;font-family:inherit;">
                🚪 &nbsp;Log Out
            </button>
        </form>
    </div>
</div>

{{-- ── RESPONSIVE DASHBOARD LAYOUT FIX ── --}}
<style>
    @media (max-width: 768px) {
        /* dashboard.blade.php specific */
        .mc-header {
            padding: 16px 20px !important;
            grid-template-columns: 1fr 1fr !important;
        }
        .mc-logo-mark { display: none !important; }
        .mc-header-right { align-items: flex-end !important; }
        .mc-content { padding: 16px !important; }
        .mc-ticker { padding: 8px 16px !important; gap: 24px !important; overflow-x: auto; }
        .stat-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .two-col { grid-template-columns: 1fr !important; gap: 24px !important; }
        .bottom-row { grid-template-columns: 1fr !important; }
        .bottom-cell { border-right: none !important; border-bottom: 1px solid var(--ink) !important; }
        .mc-footer { flex-direction: column !important; gap: 4px !important; text-align: center !important; padding: 12px !important; }
        table.mc-table th, table.mc-table td { padding: 10px 12px !important; font-size: 11px !important; }
        .stat-number { font-size: 28px !important; }
    }
    @media (max-width: 480px) {
        .stat-grid { grid-template-columns: 1fr 1fr !important; }
        .stat-number { font-size: 22px !important; }
        .mc-header .wordmark { font-size: 18px !important; }
    }
</style>

<script>
    function toggleNavDrawer() {
        const drawer = document.getElementById('navMobileDrawer');
        const overlay = document.getElementById('navMobileOverlay');
        drawer.classList.toggle('open');
        overlay.classList.toggle('open');
        document.body.style.overflow = drawer.classList.contains('open') ? 'hidden' : '';
    }
    function closeNavDrawer() {
        document.getElementById('navMobileDrawer').classList.remove('open');
        document.getElementById('navMobileOverlay').classList.remove('open');
        document.body.style.overflow = '';
    }
    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeNavDrawer();
    });
</script>