<x-kasir-layout>
    <x-slot name="title">Detail Pesanan</x-slot>

    <div class="mb-6">
        <a href="{{ route('kasir.orders.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-900 mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Pesanan
        </a>
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Pesanan #{{ $order->kode_order }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ $order->created_at->format('d M Y, H:i') }} · {{ $order->user->name ?? 'Tamu' }}</p>
            </div>
            @php
                $statusClass = match($order->status) {
                    'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                    'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                    'selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                    'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                    default => 'bg-gray-100 text-gray-700 border-gray-200',
                };
                $method = $order->payment->method ?? ($order->payment_method ?? 'cash');
                $methodLabels = ['cash' => 'Cash', 'qris' => 'QRIS', 'debit' => 'Debit'];
            @endphp
            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold border {{ $statusClass }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm mb-5">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">{{ $errors->first() }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-5">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Item Pesanan</h3>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[500px]">
                    <thead class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="pb-3 text-left font-semibold">Item</th>
                            <th class="pb-3 text-center font-semibold">Jml</th>
                            <th class="pb-3 text-right font-semibold">Harga</th>
                            <th class="pb-3 text-right font-semibold">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td class="py-3.5">
                                <div class="flex gap-3 items-center">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-50 border border-gray-100 shrink-0">
                                        @if($item->menu && $item->menu->image)
                                            <img src="{{ asset('storage/'.$item->menu->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900">{{ $item->menu->name ?? 'Dihapus' }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 text-center text-sm text-gray-600">{{ $item->qty }}</td>
                            <td class="py-3.5 text-right text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="py-3.5 text-right text-sm font-semibold text-gray-900">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-t border-gray-200">
                        <tr>
                            <td colspan="3" class="pt-4 text-right text-sm font-bold text-gray-900">Total</td>
                            <td class="pt-4 text-right text-lg font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>

            <!-- Update Status -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-sm font-bold text-gray-900 mb-4">Perbarui Status</h3>
                <form action="{{ route('kasir.orders.update', $order) }}" method="POST" class="flex gap-3">
                    @csrf @method('PUT')
                    <select name="status" class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Tertunda</option>
                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                    <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition-colors">Perbarui</button>
                </form>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-5">
            <!-- Customer Info -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Pelanggan</h3>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr($order->user->name ?? 'G', 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $order->user->name ?? 'Tamu' }}</p>
                        <p class="text-xs text-gray-400">{{ $order->user->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Pembayaran</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Metode</span>
                        <span class="font-semibold text-gray-900 uppercase">{{ $methodLabels[$method] ?? ucfirst($method) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        @if($order->payment && $order->payment->status === 'paid')
                            <span class="font-semibold text-emerald-600">✓ Lunas</span>
                        @else
                            <span class="font-semibold text-red-600 animate-pulse">Belum Bayar</span>
                        @endif
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total</span>
                        <span class="font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- ===== SUDAH LUNAS ===== --}}
                @if($order->payment && $order->payment->status === 'paid')
                <div class="mt-4 bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-bold text-emerald-700">Pembayaran Lunas</span>
                    </div>
                    <div class="space-y-1.5 text-xs">
                        @if($method === 'cash' && $order->payment->jumlah_bayar)
                        <div class="flex justify-between">
                            <span class="text-emerald-600">Jumlah Bayar</span>
                            <span class="font-bold text-emerald-800">Rp {{ number_format($order->payment->jumlah_bayar, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-emerald-600">Kembalian</span>
                            <span class="font-bold text-emerald-800">Rp {{ number_format($order->payment->jumlah_bayar - $order->total_price, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-emerald-600">Waktu Bayar</span>
                            <span class="font-semibold text-emerald-800">{{ $order->payment->paid_at ? $order->payment->paid_at->format('d M Y, H:i') : '-' }}</span>
                        </div>
                        @if($method === 'qris' && $order->payment->bukti_bayar)
                        <div class="mt-2">
                            <span class="text-emerald-600 block mb-1">Bukti Bayar</span>
                            <img src="{{ asset('storage/'.$order->payment->bukti_bayar) }}" class="w-full rounded-lg border border-emerald-200" alt="Bukti Bayar">
                        </div>
                        @endif
                    </div>
                </div>

                {{-- ===== BELUM BAYAR - CASH ===== --}}
                @elseif($order->payment && $order->payment->status === 'unpaid' && $method === 'cash')
                <div class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="text-sm font-bold text-amber-700">Konfirmasi Cash</span>
                    </div>
                    <form action="{{ route('kasir.payments.confirm', $order) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Total bayar</label>
                            <div class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_bayar" class="block text-xs font-semibold text-gray-600 mb-1.5">Uang diterima</label>
                            <input type="number" name="jumlah_bayar" id="jumlah_bayar" min="{{ $order->total_price }}" step="1000" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500" placeholder="Masukkan jumlah..." oninput="hitungKembalian()">
                        </div>
                        <div class="mb-4 bg-white border border-gray-200 rounded-lg px-3 py-2">
                            <span class="text-xs text-gray-500">Kembalian</span>
                            <p class="text-lg font-bold text-gray-900" id="kembalianDisplay">Rp 0</p>
                        </div>
                        <button type="submit" id="btnConfirm" disabled class="w-full bg-emerald-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">✓ Konfirmasi Pembayaran</button>
                    </form>
                </div>
                <script>
                    const totalHarga = {{ $order->total_price }};
                    function hitungKembalian() {
                        const jumlah = parseFloat(document.getElementById('jumlah_bayar').value) || 0;
                        const kembalian = jumlah - totalHarga;
                        const display = document.getElementById('kembalianDisplay');
                        const btn = document.getElementById('btnConfirm');
                        if (kembalian >= 0) {
                            display.textContent = 'Rp ' + kembalian.toLocaleString('id-ID');
                            display.classList.remove('text-red-600');
                            display.classList.add('text-gray-900');
                            btn.disabled = false;
                        } else {
                            display.textContent = 'Rp ' + kembalian.toLocaleString('id-ID') + ' (kurang)';
                            display.classList.remove('text-gray-900');
                            display.classList.add('text-red-600');
                            btn.disabled = true;
                        }
                    }
                </script>

                {{-- ===== BELUM BAYAR - QRIS ===== --}}
                @elseif($order->payment && $order->payment->status === 'unpaid' && $method === 'qris')
                <div class="mt-4 bg-purple-50 border border-purple-200 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        <span class="text-sm font-bold text-purple-700">Verifikasi QRIS</span>
                    </div>

                    @if($order->payment->bukti_bayar)
                        <div class="mb-3">
                            <p class="text-xs font-semibold text-gray-600 mb-2">Bukti Bayar dari Pelanggan:</p>
                            <img src="{{ asset('storage/'.$order->payment->bukti_bayar) }}" class="w-full rounded-lg border border-purple-200 shadow-sm" alt="Bukti Bayar">
                        </div>
                        <form action="{{ route('kasir.payments.confirm', $order) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-emerald-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-colors">
                                ✓ Konfirmasi Pembayaran QRIS
                            </button>
                        </form>
                    @else
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 text-center">
                            <svg class="w-8 h-8 text-amber-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-amber-700 font-semibold">Menunggu pelanggan upload bukti bayar</p>
                        </div>
                    @endif
                </div>

                {{-- ===== BELUM BAYAR - DEBIT ===== --}}
                @elseif($order->payment && $order->payment->status === 'unpaid' && $method === 'debit')
                <div class="mt-4 bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        <span class="text-sm font-bold text-blue-700">Konfirmasi Debit (EDC)</span>
                    </div>
                    <p class="text-xs text-gray-600 mb-4 leading-relaxed">
                        Proses pembayaran menggunakan mesin EDC. Setelah transaksi berhasil, klik tombol konfirmasi di bawah.
                    </p>
                    <div class="bg-white border border-gray-200 rounded-lg px-3 py-2 mb-4">
                        <span class="text-xs text-gray-500">Total yang dibayar</span>
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                    <form action="{{ route('kasir.payments.confirm', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-xl text-sm font-bold hover:bg-gray-800 transition-colors shadow-md">
                            ✓ EDC Berhasil — Konfirmasi Pembayaran
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <!-- Print Receipt -->
            @if($order->status === 'selesai')
            <a href="{{ route('kasir.receipt.print', $order) }}" target="_blank" class="block w-full bg-gray-900 text-white text-center py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition-colors">
                🖨️ Cetak Struk
            </a>
            @endif
        </div>
    </div>
</x-kasir-layout>