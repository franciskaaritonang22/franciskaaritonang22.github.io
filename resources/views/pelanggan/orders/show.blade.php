<x-pelanggan-layout title="Order Detail" :showCartSidebar="false">
    @php
        $tax = $order->total_price * 0.10;
        $grandTotal = $order->total_price + $tax;
        $statusColors = [
            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
            'diproses' => 'bg-blue-50 text-blue-700 border-blue-200',
            'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
        ];
        $statusIcons = [
            'pending' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            'diproses' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
            'selesai' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
            'dibatalkan' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
        ];
        $paymentLabels = ['cash' => 'Cash', 'qris' => 'QRIS', 'debit' => 'Debit Card'];
        $currentMethod = $order->payment_method ?? 'cash';
    @endphp

    <!-- Header -->
    <div class="px-6 md:px-10 pt-6 md:pt-10 pb-4 md:pb-6 border-b border-gray-100">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('pelanggan.orders.index') }}" class="w-9 h-9 rounded-xl border border-gray-200 bg-white flex items-center justify-center hover:bg-gray-50 transition-colors shadow-sm">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Pesanan #{{ $order->kode_order }}</h2>
                <p class="text-gray-400 text-xs mt-0.5">{{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold border {{ $statusColors[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-200' }}">
                {!! $statusIcons[$order->status] ?? '' !!}
                {{ ucfirst($order->status) }}
            </span>
            <span class="text-xs text-gray-400">•</span>
            <span class="text-xs text-gray-500">{{ $paymentLabels[$currentMethod] ?? ucfirst($currentMethod) }}</span>
            <span class="text-xs text-gray-400">•</span>
            @if($order->payment && $order->payment->status === 'paid')
                <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Lunas
                </span>
            @else
                <span class="inline-flex items-center gap-1 text-xs font-bold text-red-600">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Belum Bayar
                </span>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="mx-6 md:mx-10 mt-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="mx-6 md:mx-10 mt-6 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">{{ $errors->first() }}</div>
    @endif

    <!-- Scrollable Content -->
    <div class="flex-1 overflow-y-auto custom-scrollbar px-4 md:px-10 py-6 md:py-8 flex flex-col lg:flex-row gap-6 lg:gap-8">

        <!-- Left: Order Items -->
        <div class="flex-1">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-5">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Item Pesanan</h3>
                <div class="divide-y divide-gray-50">
                    @foreach($order->orderItems as $item)
                    <div class="py-3.5 flex items-center">
                        <div class="flex-1 flex gap-3 items-center min-w-0">
                            <div class="w-11 h-11 rounded-lg overflow-hidden bg-gray-50 border border-gray-100 shrink-0">
                                @if($item->menu && $item->menu->image)
                                    <img src="{{ asset('storage/'.$item->menu->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-bold text-gray-900 text-[13px] truncate">{{ $item->menu->name ?? 'Menu dihapus' }}</h4>
                                <p class="text-[11px] text-gray-400 mt-0.5">x{{ $item->qty }}</p>
                            </div>
                        </div>
                        <span class="text-[13px] font-bold text-gray-900 shrink-0">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Riwayat Pesanan</h3>
                <div class="space-y-4">
                    {{-- Step 1: Order Placed --}}
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div class="w-px h-full bg-gray-200 my-1"></div>
                        </div>
                        <div class="pb-4">
                            <p class="text-[13px] font-semibold text-gray-900">Pesanan Dibuat</p>
                            <p class="text-[11px] text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    {{-- Step 2: Payment --}}
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            @if($order->payment && $order->payment->status === 'paid')
                            <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            @else
                            <div class="w-7 h-7 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center animate-pulse">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            @endif
                            <div class="w-px h-full bg-gray-200 my-1"></div>
                        </div>
                        <div class="pb-4">
                            @if($order->payment && $order->payment->status === 'paid')
                            <p class="text-[13px] font-semibold text-gray-900">Pembayaran Diterima ({{ $paymentLabels[$currentMethod] ?? ucfirst($currentMethod) }})</p>
                            <p class="text-[11px] text-gray-400">{{ $order->payment->paid_at ? $order->payment->paid_at->format('d M Y, H:i') : '-' }}</p>
                            @else
                            <p class="text-[13px] font-semibold text-amber-700">Menunggu Pembayaran</p>
                            <p class="text-[11px] text-gray-400">
                                @if($currentMethod === 'cash') Silakan bayar ke kasir
                                @elseif($currentMethod === 'qris') Scan QRIS & upload bukti bayar
                                @elseif($currentMethod === 'debit') Silakan ke kasir dengan kartu debit
                                @endif
                            </p>
                            @endif
                        </div>
                    </div>

                    @if(in_array($order->status, ['diproses', 'selesai']))
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            @if($order->status !== 'selesai')<div class="w-px h-full bg-gray-200 my-1"></div>@endif
                        </div>
                        <div>
                            <p class="text-[13px] font-semibold text-gray-900">Sedang Disiapkan</p>
                            <p class="text-[11px] text-gray-400">Pesanan Anda sedang disiapkan</p>
                        </div>
                    </div>
                    @endif

                    @if($order->status === 'selesai')
                    <div class="flex gap-3">
                        <div class="flex flex-col items-center">
                            <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-[13px] font-semibold text-gray-900">Pesanan Selesai</p>
                            <p class="text-[11px] text-gray-400">{{ $order->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right: Payment Summary -->
        <div class="w-full lg:w-72 shrink-0 space-y-4">
            <div class="bg-[#112d1e] text-white rounded-2xl p-5 shadow-xl">
                <h3 class="text-sm font-bold mb-4">Ringkasan Pembayaran</h3>

                <div class="space-y-2.5 text-xs text-white/80 border-b border-white/10 pb-4 mb-4">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span class="font-medium text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pajak (10%)</span>
                        <span class="font-medium text-white">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-end mb-5">
                    <span class="text-sm font-bold">Total</span>
                    <span class="text-lg font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>

                <!-- Payment Method Info -->
                <div class="bg-[#1a3c2a] rounded-lg p-3 mb-4">
                    <p class="text-[10px] uppercase tracking-wider text-white/50 mb-1.5">Metode Pembayaran</p>
                    <div class="flex items-center gap-2">
                        @if($currentMethod === 'cash')
                        <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        @elseif($currentMethod === 'qris')
                        <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        @else
                        <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        @endif
                        <span class="text-sm font-semibold text-white">{{ $paymentLabels[$currentMethod] ?? ucfirst($currentMethod) }}</span>
                    </div>
                </div>

                <!-- Payment Status per Method -->
                @if($order->payment && $order->payment->status === 'paid')
                    {{-- LUNAS --}}
                    <div class="bg-emerald-500/20 border border-emerald-400/30 rounded-lg p-3 mb-4">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-xs font-bold text-emerald-300">Pembayaran Lunas</span>
                        </div>
                        @if($order->payment->paid_at)
                        <p class="text-[10px] text-emerald-400/70 ml-6">{{ $order->payment->paid_at->format('d M Y, H:i') }}</p>
                        @endif
                    </div>
                @else
                    {{-- BELUM BAYAR - tampilan berbeda per metode --}}
                    @if($currentMethod === 'cash')
                        <div class="bg-amber-500/20 border border-amber-400/30 rounded-lg p-3 mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-amber-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-xs font-bold text-amber-300">Belum Bayar</span>
                            </div>
                            <p class="text-[11px] text-white/70 leading-relaxed ml-6">
                                Silakan datang ke <span class="font-bold text-white">kasir</span> untuk melakukan pembayaran tunai sebesar <span class="font-bold text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </p>
                        </div>

                    @elseif($currentMethod === 'qris')
                        {{-- QRIS: QR Code + Upload Bukti --}}
                        <div class="bg-purple-500/20 border border-purple-400/30 rounded-lg p-3 mb-4">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                <span class="text-xs font-bold text-purple-300">Scan QRIS</span>
                            </div>

                            {{-- QR Code Display --}}
                            <div class="bg-white rounded-lg p-3 mb-3 flex items-center justify-center">
                                <div class="text-center">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&data=MAKECENTS-{{ $order->kode_order }}-{{ $order->total_price }}" alt="QRIS Code" class="mx-auto rounded" style="width:140px;height:140px;">
                                    <p class="text-[10px] text-gray-500 mt-2 font-semibold">MAKECENTS CAFE</p>
                                </div>
                            </div>

                            <p class="text-[11px] text-white/70 leading-relaxed mb-3">
                                Scan QR di atas, lalu upload bukti bayar.
                            </p>

                            @if($order->payment && $order->payment->bukti_bayar)
                                <div class="bg-emerald-500/20 border border-emerald-400/30 rounded-lg p-2 mb-2">
                                    <p class="text-[10px] text-emerald-300 font-bold mb-1">✓ Bukti bayar sudah diupload</p>
                                    <img src="{{ asset('storage/'.$order->payment->bukti_bayar) }}" class="w-full rounded-lg border border-white/10" alt="Bukti Bayar">
                                    <p class="text-[10px] text-white/50 mt-1">Menunggu konfirmasi kasir...</p>
                                </div>
                            @else
                                <form action="{{ route('pelanggan.payments.upload-bukti', $order) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label class="block w-full cursor-pointer">
                                        <div class="border-2 border-dashed border-white/30 rounded-lg p-3 text-center hover:border-white/60 transition-colors" id="dropZone">
                                            <svg class="w-6 h-6 text-white/50 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-[10px] text-white/60" id="fileLabel">Klik untuk upload bukti bayar</p>
                                        </div>
                                        <input type="file" name="bukti_bayar" accept="image/*" class="hidden" onchange="document.getElementById('fileLabel').textContent = this.files[0].name; document.getElementById('btnUpload').classList.remove('hidden');">
                                    </label>
                                    <button type="submit" id="btnUpload" class="hidden w-full mt-2 bg-white text-[#112d1e] font-bold py-2 rounded-lg text-xs hover:bg-gray-100 transition-colors">
                                        Upload Bukti Bayar
                                    </button>
                                </form>
                            @endif
                        </div>

                    @elseif($currentMethod === 'debit')
                        <div class="bg-blue-500/20 border border-blue-400/30 rounded-lg p-3 mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <svg class="w-4 h-4 text-blue-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                <span class="text-xs font-bold text-blue-300">Pembayaran Debit</span>
                            </div>
                            <p class="text-[11px] text-white/70 leading-relaxed ml-6">
                                Silakan datang ke <span class="font-bold text-white">kasir</span> dengan kartu debit Anda untuk melakukan pembayaran melalui mesin EDC.
                            </p>
                        </div>
                    @endif

                    <!-- Ubah Metode Pembayaran -->
                    <div class="mt-2 mb-4">
                        <button type="button" onclick="document.getElementById('changePaymentForm').classList.toggle('hidden')" class="w-full bg-red-500/10 border border-red-500/20 text-red-300 font-medium py-2 rounded-lg text-[11px] hover:bg-red-500/20 hover:text-red-200 transition-colors">
                            Batalkan & Ubah Metode Pembayaran
                        </button>
                        
                        <form id="changePaymentForm" action="{{ route('pelanggan.payments.change-method', $order) }}" method="POST" class="hidden mt-2 bg-white/5 p-3 rounded-lg border border-white/10">
                            @csrf
                            @method('PATCH')
                            <p class="text-[10px] uppercase tracking-wider text-white/50 mb-2">Pilih Metode Baru</p>
                            <div class="flex flex-col gap-1.5">
                                @if($currentMethod !== 'cash')
                                <button type="submit" name="payment_method" value="cash" class="bg-white/10 text-white text-[11px] py-1.5 rounded-lg hover:bg-white/20 transition-colors flex items-center justify-center gap-2">
                                    Tunai
                                </button>
                                @endif
                                @if($currentMethod !== 'qris')
                                <button type="submit" name="payment_method" value="qris" class="bg-white/10 text-white text-[11px] py-1.5 rounded-lg hover:bg-white/20 transition-colors flex items-center justify-center gap-2">
                                    QRIS
                                </button>
                                @endif
                                @if($currentMethod !== 'debit')
                                <button type="submit" name="payment_method" value="debit" class="bg-white/10 text-white text-[11px] py-1.5 rounded-lg hover:bg-white/20 transition-colors flex items-center justify-center gap-2">
                                    Debit
                                </button>
                                @endif
                            </div>
                        </form>
                    </div>
                @endif

                <a href="{{ route('pelanggan.orders.index') }}" class="block text-center text-xs text-white/60 hover:text-white/90 transition-colors">
                    ← Kembali ke Pesanan
                </a>
            </div>
        </div>
    </div>
</x-pelanggan-layout>