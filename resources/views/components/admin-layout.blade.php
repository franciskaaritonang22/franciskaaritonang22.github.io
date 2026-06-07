<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} - MAKECENTS Admin</title>
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
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
        .custom-scrollbar-dark::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar-dark::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar-dark::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.2); border-radius: 20px; }

        /* ── MOBILE OVERLAY ── */
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 998;
            backdrop-filter: blur(2px);
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
        }
        .mobile-badge {
            background: rgba(255,201,71,0.2);
            color: #ffc947;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
        }



        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .mobile-topbar { display: flex; }
            body { overflow: auto !important; height: auto !important; }
            .main-layout-wrap {
                flex-direction: column !important;
                padding: 0 !important;
                gap: 0 !important;
                height: auto !important;
                min-height: 100vh;
            }
            .desktop-sidebar { display: none !important; }
            .main-content-panel {
                border-radius: 0 !important;
                margin-top: 56px !important;
                margin-bottom: 0 !important;
                height: auto !important;
                overflow: visible !important;
                flex: none !important;
                box-shadow: none !important;
            }
            .main-content-panel > div {
                overflow: visible !important;
                height: auto !important;
            }
        }
        @media (min-width: 769px) {
            .mobile-topbar { display: none !important; }
            .mobile-drawer { display: none !important; }
            .mobile-overlay { display: none !important; }
        }
    </style>
</head>
<body class="bg-[#112d1e] bg-grid text-gray-800 h-screen overflow-hidden">

{{-- ── MOBILE TOPBAR ── --}}
<div class="mobile-topbar">
    <button class="mobile-hamburger" onclick="toggleMobileDrawer()">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>
    <div class="mobile-topbar-logo">MAKE<span>CENTS</span></div>
    <span class="mobile-badge">Admin 🛡️</span>
</div>

{{-- ── MOBILE OVERLAY ── --}}
<div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileDrawer()"></div>

{{-- ── MOBILE DRAWER ── --}}
<div class="mobile-drawer" id="mobileDrawer">
    <div style="margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,0.1)">
        <h1 style="font-size:2rem;font-weight:900;color:#fff;line-height:0.85;letter-spacing:-0.03em;">MA<br>KE<br>CEN<span style="display:inline-block;transform:translateY(-2px)">T</span>S</h1>
        <p style="font-size:0.6rem;letter-spacing:0.2em;margin-top:8px;color:rgba(255,255,255,0.6);text-transform:uppercase;">Admin Panel</p>
    </div>
    <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid rgba(255,255,255,0.1)">
        <div style="width:40px;height:40px;border-radius:50%;background:#f59e0b;display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;font-size:13px;flex-shrink:0;">AD</div>
        <div>
            <p style="font-weight:600;font-size:13px;color:#fff;">Admin Panel 🛡️</p>
            <p style="font-size:11px;color:rgba(255,255,255,0.6);max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ auth()->user()->email }}</p>
        </div>
    </div>
    @php $currentRoute = Route::currentRouteName(); @endphp
    <nav style="flex:1;display:flex;flex-direction:column;gap:4px;">
        <a href="{{ route('admin.dashboard') }}" onclick="closeMobileDrawer()" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;text-decoration:none;color:{{ $currentRoute == 'admin.dashboard' ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ $currentRoute == 'admin.dashboard' ? 'rgba(255,255,255,0.12)' : 'none' }};">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>Dasbor
        </a>
        <a href="{{ route('admin.categories.index') }}" onclick="closeMobileDrawer()" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;text-decoration:none;color:{{ Str::startsWith($currentRoute,'admin.categories') ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ Str::startsWith($currentRoute,'admin.categories') ? 'rgba(255,255,255,0.12)' : 'none' }};">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>Kategori
        </a>
        <a href="{{ route('admin.menus.index') }}" onclick="closeMobileDrawer()" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;text-decoration:none;color:{{ Str::startsWith($currentRoute,'admin.menus') ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ Str::startsWith($currentRoute,'admin.menus') ? 'rgba(255,255,255,0.12)' : 'none' }};">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>Menus
        </a>
        <a href="{{ route('admin.customers.index') }}" onclick="closeMobileDrawer()" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;text-decoration:none;color:{{ Str::startsWith($currentRoute,'admin.customers') ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ Str::startsWith($currentRoute,'admin.customers') ? 'rgba(255,255,255,0.12)' : 'none' }};">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>Pelanggan
        </a>
        <a href="{{ route('admin.kasirs.index') }}" onclick="closeMobileDrawer()" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;text-decoration:none;color:{{ Str::startsWith($currentRoute,'admin.kasirs') ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ Str::startsWith($currentRoute,'admin.kasirs') ? 'rgba(255,255,255,0.12)' : 'none' }};">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>Kasir
        </a>
        <a href="{{ route('admin.promos.index') }}" onclick="closeMobileDrawer()" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;text-decoration:none;color:{{ Str::startsWith($currentRoute,'admin.promos') ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ Str::startsWith($currentRoute,'admin.promos') ? 'rgba(255,255,255,0.12)' : 'none' }};">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>Promo
        </a>
        <a href="{{ route('admin.reports.index') }}" onclick="closeMobileDrawer()" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;text-decoration:none;color:{{ $currentRoute == 'admin.reports.index' ? '#fff' : 'rgba(255,255,255,0.7)' }};background:{{ $currentRoute == 'admin.reports.index' ? 'rgba(255,255,255,0.12)' : 'none' }};">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>Laporan
        </a>
    </nav>
    <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;padding-top:12px;border-top:1px solid rgba(255,255,255,0.1)">
        @csrf
        <button type="submit" style="display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:12px;font-size:14px;font-weight:500;color:rgba(255,255,255,0.7);background:none;border:none;cursor:pointer;width:100%;font-family:inherit;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>Keluar
        </button>
    </form>
</div>

{{-- ── MAIN LAYOUT ── --}}
<div class="flex h-screen p-6 gap-6 max-w-[1600px] mx-auto main-layout-wrap">
    {{-- Desktop Left Sidebar --}}
    <div class="w-60 flex-shrink-0 flex flex-col text-white pb-6 pt-2 desktop-sidebar">
        <div class="mb-10 pl-4 relative">
            <h1 class="text-[2.5rem] font-black leading-[0.8] tracking-tighter">
                MA<br>KE<br>CEN<span class="inline-block transform -translate-y-1">T</span>S
            </h1>
            <p class="text-[0.6rem] tracking-[0.2em] mt-3 opacity-80 uppercase">Coffee Space</p>
        </div>

        <div class="flex flex-col items-center gap-2 mb-10 pl-4 items-start">
            <div class="w-14 h-14 rounded-full border-2 border-white/20 bg-amber-500 flex items-center justify-center text-white font-bold text-lg">
                AD
            </div>
            <div class="mt-2">
                <p class="font-semibold text-sm">Admin Panel 🛡️</p>
                <p class="text-xs text-white/60">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <nav class="flex-1 space-y-1 pl-2 pr-4 overflow-y-auto custom-scrollbar-dark">
            @php $currentRoute = Route::currentRouteName(); @endphp
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 {{ $currentRoute == 'admin.dashboard' ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dasbor
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-4 px-4 py-3.5 {{ Str::startsWith($currentRoute, 'admin.categories') ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kategori
            </a>
            <a href="{{ route('admin.menus.index') }}" class="flex items-center gap-4 px-4 py-3.5 {{ Str::startsWith($currentRoute, 'admin.menus') ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Menus
            </a>
            <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-4 px-4 py-3.5 {{ Str::startsWith($currentRoute, 'admin.customers') ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Pelanggan
            </a>
            <a href="{{ route('admin.kasirs.index') }}" class="flex items-center gap-4 px-4 py-3.5 {{ Str::startsWith($currentRoute, 'admin.kasirs') ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Kasir
            </a>
            <a href="{{ route('admin.promos.index') }}" class="flex items-center gap-4 px-4 py-3.5 {{ Str::startsWith($currentRoute, 'admin.promos') ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Promo
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-4 px-4 py-3.5 {{ $currentRoute == 'admin.reports.index' ? 'bg-white/10' : 'hover:bg-white/5 text-white/80' }} rounded-[1.25rem] font-medium transition-colors">
                <svg class="w-5 h-5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Laporan
            </a>
        </nav>

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
        <div class="flex-1 overflow-y-auto custom-scrollbar p-4 sm:p-6 md:p-8">
            {{ $slot }}
        </div>
    </div>
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
</script>

</body>
</html>
