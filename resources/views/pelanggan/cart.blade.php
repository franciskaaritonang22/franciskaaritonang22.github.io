<x-pelanggan-layout title="Your Cart" :showCartSidebar="false">
    @php
        $cart = session('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        $cartCount = array_sum(array_column($cart, 'qty'));
        $tax = $total * 0.10; // 10% tax example
        
        $discount = 0;
        $activePromo = session('promo');
        if ($activePromo) {
            if ($activePromo['type'] === 'percentage') {
                $discount = ($total * $activePromo['discount']) / 100;
            } else {
                $discount = $activePromo['discount'];
            }
        }

        $grandTotal = max(0, $total + $tax - $discount);
        $points = floor($grandTotal / 1000); // 1 point per 1000 IDR
    @endphp

    <!-- Header -->
    <div class="px-6 md:px-10 pt-6 md:pt-10 pb-4 md:pb-6 flex flex-col md:flex-row md:justify-between items-start border-b border-gray-100 gap-4 md:gap-0">
        <div>
            <h2 class="text-[2rem] font-bold text-gray-900 tracking-tight leading-tight">Keranjang Anda</h2>
            <p class="text-gray-500 mt-1 text-sm">Tinjau pesanan Anda dan lanjutkan ke pembayaran.</p>
        </div>
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:flex-none">
                <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari menu..." class="pl-11 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-[#153323] focus:ring-1 focus:ring-[#153323] w-full md:w-[280px] bg-white text-sm">
            </div>
            <a href="{{ route('pelanggan.cart.index') }}" class="relative p-2.5 rounded-xl border border-gray-200 bg-white hover:bg-gray-50 transition-colors hidden md:block shadow-sm">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                @if($cartCount > 0)
                <span class="absolute -top-2 -right-2 bg-[#112d1e] text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </div>

    <!-- Scrollable Content -->
    <div class="flex-1 lg:overflow-y-auto lg:overflow-x-hidden custom-scrollbar px-4 md:px-8 py-6 flex flex-col md:flex-row gap-6">
        
        <!-- Cart Items List (Left Side) -->
        <div class="flex-1 min-w-0">
            <div class="bg-white rounded-[1.5rem] p-4 md:p-6 shadow-sm border border-gray-100 mb-6 overflow-x-auto">
                <!-- Table Header -->
                <div class="hidden md:flex items-center pb-3 border-b border-gray-100 text-xs font-semibold text-gray-500">
                    <div class="flex-1">Item ({{ count($cart) }})</div>
                    <div class="w-24 text-center">Harga</div>
                    <div class="w-28 text-center">Kuantitas</div>
                    <div class="w-24 text-center">Total</div>
                    <div class="w-8 text-center"></div>
                </div>

                <!-- Items -->
                <div class="divide-y divide-gray-100">
                    @forelse($cart as $id => $item)
                    <div class="py-4 flex flex-col md:flex-row md:items-center gap-3 md:gap-0 justify-between">
                        <!-- Item -->
                        <div class="flex-1 flex gap-3 items-center min-w-0">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-50 border border-gray-100 shrink-0">
                                @if(isset($item['image']) && $item['image'])
                                    <img src="{{ asset('storage/'.$item['image']) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-bold text-gray-900 text-sm md:text-xs truncate">{{ $item['name'] }}</h4>
                                <p class="text-[10px] text-gray-400 mt-0.5">Regular</p>
                                <div class="md:hidden text-xs text-gray-500 mt-1 flex items-baseline gap-1">
                                    <span>Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                    <span>•</span>
                                    <span class="font-bold text-gray-900">Total: Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            
                            <!-- Delete (Mobile only) -->
                            <div class="md:hidden shrink-0">
                                <form action="{{ route('pelanggan.cart.remove', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 p-1 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Price (Desktop only) -->
                        <div class="hidden md:block w-20 md:w-24 text-center text-xs font-medium text-gray-600 shrink-0">
                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                        </div>
                        
                        <!-- Quantity -->
                        <div class="w-full md:w-28 flex justify-between md:justify-center items-center shrink-0">
                            <span class="md:hidden text-xs text-gray-500">Kuantitas</span>
                            <div class="inline-flex items-center gap-1 border border-gray-200 rounded-lg px-2 py-0.5 bg-gray-50">
                                <form action="{{ route('pelanggan.cart.add', $id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="qty" value="-1">
                                    <button type="submit" class="text-gray-400 hover:text-gray-900 text-xs font-bold w-4 h-4 flex items-center justify-center">−</button>
                                </form>
                                <span class="text-xs font-semibold w-4 text-center text-gray-900">{{ $item['qty'] }}</span>
                                <form action="{{ route('pelanggan.cart.add', $id) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit" class="text-gray-400 hover:text-gray-900 text-xs font-bold w-4 h-4 flex items-center justify-center">+</button>
                                </form>
                            </div>
                        </div>

                        <!-- Total (Desktop only) -->
                        <div class="hidden md:block w-20 md:w-24 text-center shrink-0">
                            <span class="font-bold text-gray-900 text-xs">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>

                        <!-- Delete (Desktop only) -->
                        <div class="hidden md:flex w-8 justify-center shrink-0">
                            <form action="{{ route('pelanggan.cart.remove', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="py-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Keranjang Anda kosong</h3>
                        <p class="text-gray-500 text-sm">Sepertinya Anda belum menambahkan apa pun ke keranjang Anda.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Promo Code -->
            @if(!$activePromo)
            <div id="promo-section" class="mb-6">
                <div onclick="document.getElementById('promo-form').classList.toggle('hidden'); this.classList.toggle('bg-gray-50')" 
                     class="bg-[#f9f9f6] rounded-2xl p-4 px-6 border border-gray-100 flex items-center justify-between cursor-pointer hover:bg-gray-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-gray-900">Punya kode promo?</h4>
                            <p class="text-xs text-gray-500">Masukkan kode promo untuk mendapatkan penawaran spesial</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
                
                <form id="promo-form" action="{{ route('pelanggan.cart.promo') }}" method="POST" class="mt-3 hidden bg-white p-4 rounded-2xl border border-gray-100 flex gap-2 shadow-sm">
                    @csrf
                    <input type="text" name="promo_code" placeholder="Masukkan kode promo" required 
                           class="flex-1 border-gray-200 rounded-xl px-4 py-2 text-sm focus:border-[#112d1e] focus:ring-[#112d1e] transition uppercase">
                    <button type="submit" class="bg-[#112d1e] text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-[#1a4a30] transition">
                        Gunakan
                    </button>
                </form>
            </div>
            @else
            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 px-6 flex items-center justify-between mb-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-500 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-emerald-900 uppercase tracking-wide">Promo Aktif: {{ $activePromo['code'] }}</h4>
                        <p class="text-xs text-emerald-600">Diskon Berhasil Digunakan</p>
                    </div>
                </div>
                <form action="{{ route('pelanggan.cart.promo.remove') }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-xs font-bold text-emerald-700 hover:text-red-500 transition-colors uppercase tracking-widest">
                        Hapus
                    </button>
                </form>
            </div>
            @endif

            <div class="flex justify-between items-center px-2">
                <a href="{{ route('pelanggan.home') }}" class="flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 border border-gray-200 bg-white px-5 py-2.5 rounded-xl shadow-sm transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Lanjut Belanja
                </a>
                
                
            </div>
        </div>

        <!-- Order Summary (Right Side) -->
        <div class="w-full md:w-72 shrink-0 space-y-4 mt-6 md:mt-0">
            
            <div class="bg-[#112d1e] text-white rounded-2xl p-5 shadow-xl">
                <h3 class="text-sm font-bold mb-4">Ringkasan Pesanan</h3>
                
                <div class="space-y-2.5 text-xs text-white/80 border-b border-white/10 pb-4 mb-4">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-medium text-white">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Diskon</span>
                        <span class="font-medium text-white">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pajak (10%)</span>
                        <span class="font-medium text-white">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="flex justify-between items-end mb-4">
                    <span class="text-sm font-bold">Total</span>
                    <span class="text-lg font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
                
                @php $isGuest = Str::endsWith(auth()->user()->email, '@tamu.local'); @endphp
                @if(!$isGuest)
                <div class="bg-[#1a3c2a] rounded-lg p-3 flex gap-2 items-center mb-4">
                    <svg class="w-5 h-5 text-[#a3c9a8] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-[11px] text-white/80 leading-tight">Mendapatkan <span class="font-bold text-white">{{ $points }} poin</span> dengan pesanan ini!</p>
                </div>
                @endif
                
                <!-- Payment Method Selection -->
                <div class="mb-4">
                    <div class="relative flex items-center justify-center mb-3">
                        <div class="border-t border-white/20 w-full"></div>
                        <span class="bg-[#112d1e] px-2 text-[9px] uppercase tracking-widest text-white/50 absolute">pembayaran</span>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-2" id="paymentMethodSelector">
                        <button type="button" onclick="selectPayment('cash')" id="btn-cash" class="payment-btn bg-white/10 border-2 border-white/20 rounded-lg py-2 flex flex-col items-center gap-1 hover:bg-white/20 transition-all duration-200 group">
                            <svg class="w-5 h-5 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span class="text-[10px] font-semibold text-white/70 group-hover:text-white">Tunai</span>
                        </button>
                        <button type="button" onclick="selectPayment('qris')" id="btn-qris" class="payment-btn bg-white/10 border-2 border-white/20 rounded-lg py-2 flex flex-col items-center gap-1 hover:bg-white/20 transition-all duration-200 group">
                            <svg class="w-5 h-5 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            <span class="text-[10px] font-semibold text-white/70 group-hover:text-white">QRIS</span>
                        </button>
                        <button type="button" onclick="selectPayment('debit')" id="btn-debit" class="payment-btn bg-white/10 border-2 border-white/20 rounded-lg py-2 flex flex-col items-center gap-1 hover:bg-white/20 transition-all duration-200 group">
                            <svg class="w-5 h-5 text-white/70 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            <span class="text-[10px] font-semibold text-white/70 group-hover:text-white">Debit</span>
                        </button>
                    </div>
                </div>

                <form action="{{ route('pelanggan.checkout.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" id="paymentMethodInput" value="cash">
                    <button type="submit" class="w-full bg-white text-[#112d1e] font-bold py-2.5 rounded-xl text-sm hover:bg-gray-100 transition-colors shadow-sm">
                        Lanjut ke Pembayaran
                    </button>
                </form>

                <script>
                    function selectPayment(method) {
                        document.getElementById('paymentMethodInput').value = method;
                        document.querySelectorAll('.payment-btn').forEach(btn => {
                            btn.classList.remove('bg-white/20', 'border-white', 'ring-2', 'ring-white/30');
                            btn.classList.add('bg-white/10', 'border-white/20');
                        });
                        const selected = document.getElementById('btn-' + method);
                        selected.classList.remove('bg-white/10', 'border-white/20');
                        selected.classList.add('bg-white/20', 'border-white', 'ring-2', 'ring-white/30');
                    }
                    // Default select cash
                    selectPayment('cash');
                </script>
            </div>



        </div>

    </div>
</x-pelanggan-layout>