<x-app-layout>
<head>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Mono:wght@300;400;500&family=Cormorant+Garamond:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<style>
    :root {
        --ink: #0a0a0a;
        --paper: #f5f3ef;
        --rule: #d0cdc8;
        --accent: #1a1a1a;
        --muted: #8a8680;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background: var(--paper);
        color: var(--ink);
        font-family: 'DM Mono', monospace;
    }

    /* ── GRID OVERLAY ── */
    .dashboard-wrap {
        min-height: 100vh;
        background-image:
            linear-gradient(var(--rule) 1px, transparent 1px),
            linear-gradient(90deg, var(--rule) 1px, transparent 1px);
        background-size: 80px 80px;
        background-position: 0 0;
        padding: 0 0 80px;
    }

    /* ── HEADER ── */
    .mc-header {
        border-bottom: 2px solid var(--ink);
        padding: 28px 48px 24px;
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: end;
        background: var(--paper);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    @media (max-width: 768px) {
        .mc-header { top: 56px; }
    }

    .mc-brand {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .mc-brand .wordmark {
        font-family: 'DM Serif Display', serif;
        font-size: 28px;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        line-height: 1;
    }

    .mc-brand .tagline {
        font-family: 'DM Mono', monospace;
        font-size: 10px;
        font-weight: 300;
        letter-spacing: 0.4em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .mc-logo-mark {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mc-header-right {
        text-align: right;
        display: flex;
        flex-direction: column;
        gap: 4px;
        align-items: flex-end;
    }

    .mc-header-right .greeting {
        font-size: 9px;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .mc-header-right .username {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 0.05em;
    }

    .mc-header-right .date-str {
        font-size: 9px;
        color: var(--muted);
        letter-spacing: 0.2em;
    }

    /* ── TICKER ── */
    .mc-ticker {
        border-bottom: 1px solid var(--rule);
        padding: 10px 48px;
        background: var(--ink);
        color: var(--paper);
        display: flex;
        gap: 48px;
        overflow: hidden;
        font-size: 10px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    }

    .mc-ticker span { white-space: nowrap; opacity: 0.7; }
    .mc-ticker span b { opacity: 1; margin-left: 8px; }

    /* ── MAIN CONTENT ── */
    .mc-content {
        padding: 48px;
        display: grid;
        gap: 0;
    }

    /* ── SECTION LABEL ── */
    .section-label {
        font-size: 9px;
        letter-spacing: 0.4em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--rule);
    }

    /* ── STAT GRID ── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border: 1px solid var(--ink);
        margin-bottom: 48px;
    }

    .stat-cell {
        padding: 32px 28px;
        border-right: 1px solid var(--ink);
        position: relative;
        transition: background 0.2s;
    }

    .stat-cell:last-child { border-right: none; }
    .stat-cell:hover { background: var(--ink); color: var(--paper); }
    .stat-cell:hover .stat-label { color: rgba(245,243,239,0.5); }
    .stat-cell:hover .stat-change { color: rgba(245,243,239,0.6); }

    .stat-label {
        font-size: 9px;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 16px;
        transition: color 0.2s;
    }

    .stat-number {
        font-family: 'DM Serif Display', serif;
        font-size: 42px;
        line-height: 1;
        margin-bottom: 8px;
        letter-spacing: -0.02em;
    }

    .stat-change {
        font-size: 10px;
        color: var(--muted);
        transition: color 0.2s;
    }

    .stat-change.up::before { content: '↑ '; }
    .stat-change.down::before { content: '↓ '; }

    /* ── TWO-COL LAYOUT ── */
    .two-col {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 48px;
        margin-bottom: 48px;
    }

    /* ── ORDER TABLE ── */
    .mc-table-wrap {
        border: 1px solid var(--ink);
    }

    .mc-table-header {
        background: var(--ink);
        color: var(--paper);
        padding: 14px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mc-table-header span {
        font-size: 9px;
        letter-spacing: 0.4em;
        text-transform: uppercase;
    }

    .mc-table-header a {
        font-size: 9px;
        letter-spacing: 0.2em;
        color: var(--paper);
        opacity: 0.5;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .mc-table-header a:hover { opacity: 1; }

    table.mc-table {
        width: 100%;
        border-collapse: collapse;
    }

    table.mc-table th {
        font-size: 8px;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--muted);
        padding: 12px 24px;
        text-align: left;
        border-bottom: 1px solid var(--rule);
        font-weight: 400;
    }

    table.mc-table td {
        padding: 14px 24px;
        font-size: 12px;
        border-bottom: 1px solid var(--rule);
        letter-spacing: 0.02em;
    }

    table.mc-table tr:last-child td { border-bottom: none; }

    table.mc-table tr:hover td { background: rgba(10,10,10,0.03); }

    .badge {
        display: inline-block;
        font-size: 8px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        padding: 3px 8px;
        border: 1px solid currentColor;
    }

    .badge-pending { color: #8a6a00; }
    .badge-done { color: #2a6a2a; }
    .badge-process { color: #004a8a; }

    /* ── SIDE PANEL ── */
    .side-panel { display: flex; flex-direction: column; gap: 1px; }

    .menu-popular-item {
        border: 1px solid var(--ink);
        padding: 20px 24px;
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 16px;
        align-items: center;
        transition: background 0.2s;
        margin-bottom: -1px;
    }

    .menu-popular-item:hover { background: var(--ink); color: var(--paper); }

    .menu-rank {
        font-family: 'DM Serif Display', serif;
        font-size: 28px;
        color: var(--rule);
        line-height: 1;
        transition: color 0.2s;
        width: 32px;
    }

    .menu-popular-item:hover .menu-rank { color: rgba(245,243,239,0.2); }

    .menu-info .menu-name {
        font-size: 13px;
        font-weight: 500;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }

    .menu-info .menu-cat {
        font-size: 9px;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--muted);
        transition: color 0.2s;
    }

    .menu-popular-item:hover .menu-cat { color: rgba(245,243,239,0.4); }

    .menu-count {
        font-family: 'DM Serif Display', serif;
        font-size: 22px;
        text-align: right;
    }

    /* ── BOTTOM ROW ── */
    .bottom-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        border: 1px solid var(--ink);
    }

    .bottom-cell {
        padding: 32px 28px;
        border-right: 1px solid var(--ink);
    }

    .bottom-cell:last-child { border-right: none; }

    .bottom-cell .cell-label {
        font-size: 9px;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 20px;
    }

    /* ── CHART BAR ── */
    .bar-chart {
        display: flex;
        align-items: flex-end;
        gap: 6px;
        height: 80px;
    }

    .bar-wrap { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 6px; }

    .bar {
        width: 100%;
        background: var(--ink);
        transition: opacity 0.2s;
        min-height: 4px;
    }

    .bar:hover { opacity: 0.5; }

    .bar-label {
        font-size: 8px;
        letter-spacing: 0.1em;
        color: var(--muted);
        text-transform: uppercase;
    }

    /* ── QUICK LINKS ── */
    .quick-links { display: flex; flex-direction: column; gap: 12px; }

    .quick-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        border: 1px solid var(--rule);
        font-size: 11px;
        letter-spacing: 0.1em;
        text-decoration: none;
        color: var(--ink);
        transition: all 0.2s;
    }

    .quick-link:hover {
        background: var(--ink);
        color: var(--paper);
        border-color: var(--ink);
    }

    .quick-link span:last-child { font-size: 14px; }

    /* ── QUOTE ── */
    .mc-quote {
        padding: 32px 28px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .quote-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: 22px;
        font-weight: 300;
        line-height: 1.5;
        letter-spacing: 0.02em;
    }

    .quote-attr {
        font-size: 9px;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--muted);
        margin-top: 20px;
    }

    /* ── FOOTER STRIP ── */
    .mc-footer {
        border-top: 2px solid var(--ink);
        padding: 16px 48px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--paper);
        margin: 0 0 -80px;
        font-size: 9px;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--muted);
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .stat-grid { grid-template-columns: repeat(2, 1fr); }
        .two-col { grid-template-columns: 1fr; }
        .bottom-row { grid-template-columns: 1fr; }
        .bottom-cell { border-right: none; border-bottom: 1px solid var(--ink); }
        .mc-header { padding: 20px 24px; }
        .mc-content { padding: 24px; }
        .mc-ticker { padding: 10px 24px; }
    }
    @media (max-width: 768px) {
        .dashboard-wrap { padding-bottom: 40px; }
        .mc-header {
            grid-template-columns: 1fr 1fr !important;
            padding: 14px 16px !important;
            gap: 8px;
        }
        .mc-logo-mark { display: none !important; }
        .mc-brand .wordmark { font-size: 18px; }
        .mc-brand .tagline { font-size: 8px; }
        .mc-header-right .username { font-size: 14px; }
        .mc-ticker {
            padding: 8px 16px !important;
            gap: 20px !important;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .mc-ticker::-webkit-scrollbar { display: none; }
        .mc-content { padding: 12px !important; }
        .stat-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            margin-bottom: 24px;
        }
        .stat-cell { padding: 18px 14px !important; }
        .stat-number { font-size: 26px !important; }
        .two-col {
            grid-template-columns: 1fr !important;
            gap: 24px !important;
            margin-bottom: 24px;
        }
        .bottom-row { grid-template-columns: 1fr !important; }
        .bottom-cell { border-right: none !important; border-bottom: 1px solid var(--ink) !important; }
        table.mc-table th { padding: 10px 12px !important; font-size: 8px !important; }
        table.mc-table td { padding: 10px 12px !important; font-size: 11px !important; }
        .mc-footer {
            flex-direction: column !important;
            gap: 4px !important;
            text-align: center !important;
            padding: 12px 16px !important;
        }
        .menu-popular-item { padding: 14px 16px; gap: 10px; }
        .menu-rank { font-size: 20px; width: 24px; }
        .quick-link { padding: 10px 12px; font-size: 10px; }
    }
    @media (max-width: 480px) {
        .stat-number { font-size: 20px !important; }
        .stat-cell { padding: 14px 10px !important; }
        .mc-table-header span { font-size: 8px; }
    }

    /* ── FADE IN ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .stat-cell   { animation: fadeUp 0.4s ease both; }
    .stat-cell:nth-child(1) { animation-delay: 0.05s; }
    .stat-cell:nth-child(2) { animation-delay: 0.10s; }
    .stat-cell:nth-child(3) { animation-delay: 0.15s; }
    .stat-cell:nth-child(4) { animation-delay: 0.20s; }
</style>

<div class="dashboard-wrap">

    {{-- ── HEADER ── --}}
    <header class="mc-header">
        <div class="mc-brand">
            <div class="wordmark">Makecents</div>
            <div class="tagline">Coffee Space · Dashboard</div>
        </div>

        {{-- Logo Mark SVG --}}
        <div class="mc-logo-mark">
            <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="26" cy="22" r="16" stroke="#0a0a0a" stroke-width="3" fill="none"/>
                <path d="M10 22 Q10 40 26 40 Q42 40 42 22" stroke="#0a0a0a" stroke-width="3" fill="none"/>
                <line x1="26" y1="38" x2="26" y2="50" stroke="#0a0a0a" stroke-width="3"/>
                <line x1="18" y1="50" x2="34" y2="50" stroke="#0a0a0a" stroke-width="3"/>
                <path d="M18 16 Q18 10 26 10 Q34 10 34 16" stroke="#0a0a0a" stroke-width="2.5" fill="none"/>
            </svg>
        </div>

        <div class="mc-header-right">
            <div class="greeting">Selamat datang kembali</div>
            <div class="username">{{ Auth::user()->name }}</div>
            <div class="date-str">{{ now()->translatedFormat('d F Y') }}</div>
        </div>
    </header>

    {{-- ── TICKER ── --}}
    <div class="mc-ticker">
        <span>Status <b>Buka</b></span>
        <span>Pesanan Hari Ini <b>—</b></span>
        <span>Meja Tersedia <b>—</b></span>
        <span>Pendapatan <b>—</b></span>
        <span>Jl. Mayjen D.I Panjaitan No.177, Medan Baru · Sumatera Utara 20111</span>
    </div>

    {{-- ── MAIN ── --}}
    <div class="mc-content">

        {{-- STAT GRID --}}
        <div class="section-label">ringkasan hari ini</div>
        <div class="stat-grid">
            <div class="stat-cell">
                <div class="stat-label">Total Pesanan</div>
                <div class="stat-number">
                    {{ \App\Models\Pesanan::whereDate('created_at', today())->count() ?? '—' }}
                </div>
                <div class="stat-change up">dari kemarin</div>
            </div>
            <div class="stat-cell">
                <div class="stat-label">Pendapatan</div>
                <div class="stat-number" style="font-size:32px;">
                    Rp {{ number_format(\App\Models\Pesanan::whereDate('created_at', today())->sum('total') ?? 0, 0, ',', '.') }}
                </div>
                <div class="stat-change up">hari ini</div>
            </div>
            <div class="stat-cell">
                <div class="stat-label">Menu Aktif</div>
                <div class="stat-number">
                    {{ \App\Models\Menu::count() ?? '—' }}
                </div>
                <div class="stat-change">item tersedia</div>
            </div>
            <div class="stat-cell">
                <div class="stat-label">Pelanggan Baru</div>
                <div class="stat-number">
                    {{ \App\Models\User::whereDate('created_at', today())->count() ?? '—' }}
                </div>
                <div class="stat-change up">registrasi hari ini</div>
            </div>
        </div>

        {{-- TWO COL --}}
        <div class="two-col">

            {{-- ORDER TABLE --}}
            <div>
                <div class="section-label">pesanan terbaru</div>
                <div class="mc-table-wrap">
                    <div class="mc-table-header">
                        <span>Log Transaksi</span>
                        <a href="#">Lihat Semua →</a>
                    </div>
                    <table class="mc-table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Ganti dengan data real dari controller --}}
                            @php
                                $pesanans = \App\Models\Pesanan::with('user')
                                    ->latest()->take(6)->get();
                            @endphp
                            @forelse($pesanans as $p)
                            <tr>
                                <td>#{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $p->user->name ?? 'Guest' }}</td>
                                <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                                <td>
                                    @if($p->status === 'selesai')
                                        <span class="badge badge-done">Selesai</span>
                                    @elseif($p->status === 'proses')
                                        <span class="badge badge-process">Proses</span>
                                    @else
                                        <span class="badge badge-pending">Pending</span>
                                    @endif
                                </td>
                                <td>{{ $p->created_at->format('H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align:center; color:var(--muted); padding:32px;">
                                    Belum ada pesanan hari ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- MENU POPULER --}}
            <div>
                <div class="section-label">menu populer</div>
                <div class="side-panel">
                    @php
                        $populer = [
                            ['nama' => 'Espresso Classic',  'kat' => 'Coffee',     'jual' => 84],
                            ['nama' => 'Matcha Latte',      'kat' => 'Non-Coffee', 'jual' => 71],
                            ['nama' => 'Croissant Butter',  'kat' => 'Pastry',     'jual' => 63],
                            ['nama' => 'Cold Brew',         'kat' => 'Coffee',     'jual' => 58],
                            ['nama' => 'Caramel Macchiato', 'kat' => 'Coffee',     'jual' => 49],
                        ];
                    @endphp
                    @foreach($populer as $i => $m)
                    <div class="menu-popular-item">
                        <div class="menu-rank">{{ $i + 1 }}</div>
                        <div class="menu-info">
                            <div class="menu-name">{{ $m['nama'] }}</div>
                            <div class="menu-cat">{{ $m['kat'] }}</div>
                        </div>
                        <div class="menu-count">{{ $m['jual'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- BOTTOM ROW --}}
        <div class="section-label">analitik & navigasi</div>
        <div class="bottom-row">

            {{-- BAR CHART --}}
            <div class="bottom-cell">
                <div class="cell-label">Penjualan 7 Hari</div>
                @php
                    $bars = [
                        ['d'=>'Sen','v'=>65],['d'=>'Sel','v'=>80],['d'=>'Rab','v'=>55],
                        ['d'=>'Kam','v'=>90],['d'=>'Jum','v'=>100],['d'=>'Sab','v'=>85],['d'=>'Min','v'=>45],
                    ];
                    $max = max(array_column($bars, 'v'));
                @endphp
                <div class="bar-chart">
                    @foreach($bars as $b)
                    <div class="bar-wrap">
                        <div class="bar" style="height: {{ ($b['v']/$max)*80 }}px;" title="{{ $b['d'] }}: {{ $b['v'] }}"></div>
                        <div class="bar-label">{{ $b['d'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- QUICK LINKS --}}
            <div class="bottom-cell">
                <div class="cell-label">Navigasi Cepat</div>
                <div class="quick-links">
                    <a href="{{ route('menu.index') }}" class="quick-link">
                        <span>Kelola Menu</span>
                        <span>→</span>
                    </a>
                    <a href="{{ route('keranjang.index') }}" class="quick-link">
                        <span>Keranjang</span>
                        <span>→</span>
                    </a>
                    <a href="#" class="quick-link">
                        <span>Laporan</span>
                        <span>→</span>
                    </a>
                    <a href="#" class="quick-link">
                        <span>Pengaturan</span>
                        <span>→</span>
                    </a>
                </div>
            </div>

            {{-- QUOTE --}}
            <div class="bottom-cell mc-quote">
                <div>
                    <div class="quote-text">
                        "Have a Good<br>sense of coffee."
                    </div>
                    <div class="quote-attr">— Makecents Coffee Space</div>
                </div>
                <div style="margin-top:32px;">
                    <svg width="40" height="40" viewBox="0 0 52 52" fill="none">
                        <circle cx="26" cy="22" r="16" stroke="#0a0a0a" stroke-width="2.5" fill="none"/>
                        <path d="M10 22 Q10 40 26 40 Q42 40 42 22" stroke="#0a0a0a" stroke-width="2.5" fill="none"/>
                        <line x1="26" y1="38" x2="26" y2="50" stroke="#0a0a0a" stroke-width="2.5"/>
                        <line x1="18" y1="50" x2="34" y2="50" stroke="#0a0a0a" stroke-width="2.5"/>
                    </svg>
                </div>
            </div>

        </div>

    </div>

    {{-- ── FOOTER ── --}}
    <div class="mc-footer">
        <span>Makecents Coffee Space</span>
        <span>Take care of yourself, use your mask.</span>
        <span>Jl. Mayjen D.I Panjaitan No.177 · Medan</span>
    </div>

</div>

</x-app-layout>