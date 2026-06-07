<x-kasir-layout>
    <x-slot name="title">Dasbor</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dasbor</h1>
        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, {{ auth()->user()->name }}</p>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-8">
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Tertunda</span>
            </div>
            <p class="text-3xl font-bold text-amber-700">{{ $pendingOrders }}</p>
            <p class="text-xs text-amber-500 mt-1">Menunggu tindakan</p>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Diproses</span>
            </div>
            <p class="text-3xl font-bold text-blue-700">{{ $processingOrders }}</p>
            <p class="text-xs text-blue-500 mt-1">Sedang disiapkan</p>
        </div>

        <div class="bg-red-50 border border-red-100 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-red-600 uppercase tracking-wider">Belum Bayar</span>
            </div>
            <p class="text-3xl font-bold text-red-700">{{ $unpaidOrders }}</p>
            <p class="text-xs text-red-500 mt-1">Menunggu pembayaran</p>
        </div>

        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Total Aktif</span>
            </div>
            <p class="text-3xl font-bold text-emerald-700">{{ $pendingOrders + $processingOrders }}</p>
            <p class="text-xs text-emerald-500 mt-1">Pesanan untuk ditangani</p>
        </div>
    </div>

    <!-- Active Orders -->
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-lg font-bold text-gray-900">Pesanan Aktif</h2>
        <a href="{{ route('kasir.orders.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">Lihat Semua →</a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Pesanan</th>
                        <th class="px-5 py-3 font-semibold">Pelanggan</th>
                        <th class="px-5 py-3 font-semibold">Total</th>
                        <th class="px-5 py-3 font-semibold">Metode</th>
                        <th class="px-5 py-3 font-semibold">Status Bayar</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $o)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-3.5">
                            <span class="text-sm font-bold text-gray-900">#{{ $o->kode_order }}</span>
                            <p class="text-[11px] text-gray-400">{{ $o->created_at->format('H:i') }}</p>
                        </td>
                        <td class="px-5 py-3.5 text-sm text-gray-600">{{ $o->user->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm font-semibold text-gray-900">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-semibold bg-gray-100 text-gray-600 uppercase">
                                {{ $o->payment_method ?? 'cash' }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($o->payment && $o->payment->status === 'paid')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Lunas
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700 animate-pulse">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Belum Bayar
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            @php
                                $statusClass = match($o->status) {
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'diproses' => 'bg-blue-100 text-blue-700',
                                    'selesai' => 'bg-emerald-100 text-emerald-700',
                                    'dibatalkan' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                {{ ucfirst($o->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('kasir.orders.show', $o) }}" class="text-sm font-semibold text-indigo-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-10 text-center text-gray-400 text-sm">Tidak ada pesanan aktif saat ini ☕</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-kasir-layout>