<x-pelanggan-layout title="Our Menu">
<style>
    :root {
        --green-dark: #112d1e;
        --green-mid: #1f4a33;
        --green-light: #2a6b4a;
        --bg-card: #ffffff;
        --text-primary: #111111;
        --text-secondary: #666666;
        --text-muted: #999999;
        --border: #e8e8e4;
    }

    /* Override layout: buat area konten + keranjang jadi putih */
    .mc-page-wrap {
        display: flex;
        flex: 1;
        min-height: 100vh;
        background: #f5f5f0;
        border-radius: 20px 0 0 20px;
        overflow: hidden;
    }
    .mc-menu-col {
        flex: 1;
        min-width: 0;
        background: #f5f5f0;
        overflow-y: auto;
        padding-bottom: 40px;
    }
    .mc-cart-col {
        width: 260px;
        flex-shrink: 0;
        background: #f5f5f0;
        border-left: 1px solid #e8e8e4;
        padding: 28px 20px 40px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        overflow-y: auto;
    }
    .mc-cart-box {
        background: #ffffff;
        border-radius: 18px;
        padding: 18px;
        border: 1px solid #e8e8e4;
    }
    .mc-cart-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .mc-cart-title span {
        font-size: 14px;
        font-weight: 700;
        color: #111;
    }
    .mc-cart-badge {
        background: #112d1e;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .mc-cart-item {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 14px;
    }
    .mc-cart-item-img {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: #f0f0ea;
    }
    .mc-cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .mc-cart-item-name { font-size: 12px; font-weight: 600; color: #111; margin-bottom: 2px; }
    .mc-cart-item-price { font-size: 11px; color: #999; margin-bottom: 6px; }
    .mc-qty-ctrl { display: flex; align-items: center; gap: 6px; }
    .mc-qty-btn {
        width: 20px; height: 20px; border-radius: 6px;
        border: 1px solid #e8e8e4; background: #f5f5f0;
        font-size: 13px; cursor: pointer; display: flex;
        align-items: center; justify-content: center;
        color: #666; transition: background 0.15s; line-height: 1;
    }
    .mc-qty-btn:hover { background: #e8e8e4; }
    .mc-qty-num { font-size: 12px; font-weight: 600; color: #111; min-width: 16px; text-align: center; }
    .mc-cart-divider { border: none; border-top: 1px solid #f0f0f0; margin: 10px 0; }
    .mc-cart-row { display: flex; justify-content: space-between; font-size: 12px; color: #999; margin-bottom: 5px; }
    .mc-cart-total { display: flex; justify-content: space-between; font-size: 14px; font-weight: 700; color: #111; margin-top: 4px; }
    .mc-view-cart-btn {
        width: 100%; background: #112d1e; color: #fff;
        font-size: 13px; font-weight: 700; padding: 12px;
        border-radius: 12px; border: none; cursor: pointer;
        margin-top: 14px; transition: background 0.15s;
    }
    .mc-view-cart-btn:hover { background: #1f4a33; }
    .mc-cart-empty { text-align: center; padding: 24px 0; color: #999; font-size: 12px; }
    .mc-cart-empty svg { width: 36px; height: 36px; margin-bottom: 8px; color: #ddd; display: block; margin-left: auto; margin-right: auto; }
    .mc-promo-box {
        background: #112d1e; border-radius: 18px;
        padding: 18px; display: flex; gap: 12px; align-items: flex-start;
    }
    .mc-promo-text p { color: #fff; font-size: 13px; font-weight: 700; margin-bottom: 5px; line-height: 1.4; }
    .mc-promo-text span { color: rgba(255,255,255,0.55); font-size: 11px; display: block; margin-bottom: 10px; }
    .mc-promo-btn {
        background: rgba(255,255,255,0.15); color: #fff;
        font-size: 11px; font-weight: 600; padding: 6px 12px;
        border-radius: 8px; border: none; cursor: pointer; transition: background 0.15s;
    }
    .mc-promo-btn:hover { background: rgba(255,255,255,0.25); }

    .mc-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        padding: 28px 28px 0;
    }
    .mc-header h2 {
        font-size: 26px;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.5px;
    }
    .mc-header p {
        color: var(--text-muted);
        font-size: 13px;
        margin-top: 3px;
    }
    .mc-search {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 9px 16px;
        width: 220px;
        transition: border-color 0.2s;
    }
    .mc-search:hover { border-color: #c0c0b8; }
    .mc-search input {
        border: none;
        outline: none;
        background: transparent;
        font-size: 13px;
        color: var(--text-primary);
        width: 100%;
    }
    .mc-search input::placeholder { color: var(--text-muted); }
    .mc-search svg { width: 15px; height: 15px; flex-shrink: 0; color: var(--text-muted); }

    .mc-cats {
        display: flex;
        gap: 8px;
        margin-bottom: 0;
        flex-wrap: wrap;
        padding: 16px 28px 0;
    }
    .mc-cat {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        border: 1.5px solid var(--border);
        background: var(--bg-card);
        color: var(--text-secondary);
        text-decoration: none;
    }
    .mc-cat svg { width: 13px; height: 13px; }
    .mc-cat:hover {
        background: #e6f4ed;
        border-color: var(--green-light);
        color: var(--green-dark);
    }
    .mc-cat.active {
        background: var(--green-dark);
        color: #ffffff;
        border-color: var(--green-dark);
    }

    .mc-banner {
        background: var(--green-dark);
        border-radius: 22px;
        overflow: hidden;
        display: flex;
        align-items: stretch;
        margin: 20px 28px 28px;
        height: 150px;
        position: relative;
    }
    .mc-banner-bg {
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.07;
        pointer-events: none;
    }
    .mc-banner-content {
        padding: 0 32px;
        flex: 1;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .mc-banner-content h3 {
        color: #ffffff;
        font-size: 15px;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 6px;
    }
    .mc-banner-content p {
        color: rgba(255,255,255,0.65);
        font-size: 12px;
        margin-bottom: 14px;
    }
    .mc-banner-btn {
        background: #ffffff;
        color: var(--green-dark);
        font-size: 12px;
        font-weight: 700;
        padding: 8px 18px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        width: fit-content;
        transition: background 0.15s;
    }
    .mc-banner-btn:hover { background: #f0f0e8; }
    .mc-banner-img {
        width: 210px;
        object-fit: cover;
        flex-shrink: 0;
        opacity: 0.88;
        clip-path: polygon(12% 0, 100% 0, 100% 100%, 0% 100%);
    }

    .mc-section-wrap {
        padding: 0 28px;
        margin-bottom: 28px;
    }
    .mc-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }
    .mc-section-header h3 {
        font-size: 15px;
        font-weight: 700;
        color: var(--text-primary);
    }
    .mc-see-all {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 500;
        text-decoration: none;
        transition: color 0.15s;
    }
    .mc-see-all:hover { color: var(--green-dark); }

    .mc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 14px;
    }
    .mc-card {
        background: var(--bg-card);
        border-radius: 18px;
        padding: 14px;
        border: 1px solid var(--border);
        cursor: pointer;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .mc-card:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,0.09);
        transform: translateY(-2px);
    }
    .mc-card-img {
        width: 100%;
        aspect-ratio: 4/3;
        border-radius: 12px;
        overflow: hidden;
        background: #f0f0ea;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .mc-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .mc-card:hover .mc-card-img img { transform: scale(1.08); }
    .mc-no-img {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
    }
    .mc-no-img svg { width: 28px; height: 28px; }
    .mc-card-name {
        font-size: 12px;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 6px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .mc-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }
    .mc-card-price {
        font-size: 12px;
        color: var(--text-secondary);
        font-weight: 500;
    }
    .mc-add-btn {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--green-dark);
        border: none;
        color: #ffffff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s, transform 0.15s;
        flex-shrink: 0;
    }
    .mc-add-btn:hover {
        background: var(--green-mid);
        transform: scale(1.1);
    }
    .mc-add-btn svg { width: 14px; height: 14px; }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .mc-page-wrap {
            border-radius: 0 !important;
            min-height: auto !important;
        }
        .mc-header { flex-direction: column; gap: 16px; padding: 20px 20px 0; }
        .mc-search { width: 100%; }
        .mc-cats { 
            flex-wrap: wrap; 
            padding: 16px 20px 0; 
            justify-content: flex-start;
        }
        .mc-cat { padding: 6px 14px; font-size: 13px; }
        .mc-banner { flex-direction: column-reverse; height: auto; margin: 20px; border-radius: 16px; }
        .mc-banner-img { width: 100%; height: 160px; clip-path: none; border-radius: 16px 16px 0 0; }
        .mc-banner-content { padding: 24px 20px; align-items: flex-start; }
        .mc-section-wrap { padding: 0 20px; margin-bottom: 24px; }
        .mc-grid { grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 16px; }
    }
</style>

<div class="mc-page-wrap">
<div class="mc-menu-col">

{{-- Header --}}
<div class="mc-header">
    <div>
        <h2>Menu</h2>
        <p>Dibuat dengan kualitas terbaik, khusus untuk Anda.</p>
    </div>
    <div class="mc-search">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" placeholder="Cari menu..." id="mc-search-input">
    </div>
</div>

{{-- Categories --}}
<div class="mc-cats">
    <a href="{{ route('pelanggan.home') }}" class="mc-cat {{ !request('category') ? 'active' : '' }}">Semua</a>

    @foreach($categories as $cat)
        <a href="{{ route('pelanggan.home', ['category' => $cat->id]) }}"
           class="mc-cat {{ request('category') == $cat->id ? 'active' : '' }}">

            @if(stripos($cat->name, 'coffee') !== false && stripos($cat->name, 'non') === false)
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8h1a4 4 0 010 8h-1"/>
                    <path d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"/>
                </svg>
            @elseif(stripos($cat->name, 'non') !== false)
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 6h12l-2 14H8L6 6z"/>
                    <path d="M5 6h14"/>
                </svg>
            @elseif(stripos($cat->name, 'dessert') !== false || stripos($cat->name, 'manis') !== false)
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l-1.5 3h3L12 2z"/>
                    <path d="M5 8h14v4a2 2 0 01-2 2H7a2 2 0 01-2-2V8z"/>
                    <path d="M4 14h16v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6z"/>
                </svg>
            @elseif(stripos($cat->name, 'food') !== false || stripos($cat->name, 'makanan') !== false || stripos($cat->name, 'snack') !== false)
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="6" width="14" height="12" rx="2"/>
                </svg>
            @else
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="16"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
            @endif

            {{ $cat->name }}
        </a>
    @endforeach
</div>

{{-- Banner --}}
<div class="mc-banner">
    <div class="mc-banner-bg"></div>
    <div class="mc-banner-content">
        <h3>Kopi Spesialti<br>Dibuat dengan Sepenuh Hati</h3>
        <p>Setiap cangkir mendukung hari terbaik Anda.</p>
        <button class="mc-banner-btn">Jelajahi Sekarang</button>
    </div>
    <img class="mc-banner-img"
         src="https://images.unsplash.com/photo-1541167760496-1628856ab772?q=80&w=600&auto=format&fit=crop"
         alt="Specialty Coffee">
</div>

{{-- Menus grouped by category --}}
@php
    $groupedMenus = $menus->groupBy('category.name');
    if (request('category')) {
        $selectedCat = $categories->firstWhere('id', request('category'));
        if ($selectedCat) {
            $groupedMenus = collect([$selectedCat->name => $menus]);
        }
    }
@endphp

@foreach($groupedMenus as $catName => $catMenus)
    <div class="mc-section-wrap">
        <div class="mc-section-header">
            <h3>{{ $catName }}</h3>
            <a href="{{ route('pelanggan.home', ['category' => $catMenus->first()->category_id]) }}" class="mc-see-all">Lihat Semua</a>
        </div>

        <div class="mc-grid">
            @foreach($catMenus as $menu)
                <div class="mc-card mc-menu-item" data-name="{{ strtolower($menu->name) }}">
                    <div class="mc-card-img">
                        @if($menu->image)
                            <img src="{{ asset('storage/'.$menu->image) }}" alt="{{ $menu->name }}" loading="lazy">
                        @else
                            <div class="mc-no-img">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="mc-card-name">{{ $menu->name }}</div>
                    <div class="mc-card-footer">
                        <span class="mc-card-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        <form action="{{ route('pelanggan.cart.add', $menu) }}" method="POST" style="display:inline">
                            @csrf
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="mc-add-btn" title="Tambah ke keranjang">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('mc-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var q = this.value.toLowerCase().trim();
            document.querySelectorAll('.mc-menu-item').forEach(function(card) {
                var name = card.dataset.name || '';
                card.style.display = (!q || name.includes(q)) ? '' : 'none';
            });
        });
    }
});
</script>

</div>{{-- end mc-menu-col --}}

</div>{{-- end mc-page-wrap --}}

</x-pelanggan-layout>