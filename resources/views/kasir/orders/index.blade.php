<x-kasir-layout>
    <x-slot name="title">Semua Pesanan</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Semua Pesanan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola dan lacak semua pesanan pelanggan</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('kasir.orders.index') }}" class="{{ !request('status') ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }} px-4 py-2 rounded-xl text-sm font-semibold">Semua</a>
            <a href="{{ route('kasir.orders.index', ['status' => 'pending']) }}" class="{{ request('status') === 'pending' ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }} px-4 py-2 rounded-xl text-sm font-semibold">Tertunda</a>
            <a href="{{ route('kasir.orders.index', ['status' => 'diproses']) }}" class="{{ request('status') === 'diproses' ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }} px-4 py-2 rounded-xl text-sm font-semibold">Diproses</a>
            <a href="{{ route('kasir.orders.index', ['status' => 'selesai']) }}" class="{{ request('status') === 'selesai' ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }} px-4 py-2 rounded-xl text-sm font-semibold">Selesai</a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm mb-5">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Pesanan</th>
                        <th class="px-5 py-3 font-semibold">Pelanggan</th>
                        <th class="px-5 py-3 font-semibold">Tanggal</th>
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
                        <td class="px-5 py-3.5 text-sm font-bold text-gray-900">#{{ $o->kode_order }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-600">{{ $o->user->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $o->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-5 py-3.5 text-sm font-semibold text-gray-900">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-semibold bg-gray-100 text-gray-600 uppercase">{{ $o->payment_method ?? 'cash' }}</span>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($o->payment && $o->payment->status === 'paid')
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Lunas</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Belum Bayar</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            @php
                                $sc = match($o->status) {
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'diproses' => 'bg-blue-100 text-blue-700',
                                    'selesai' => 'bg-emerald-100 text-emerald-700',
                                    'dibatalkan' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $sc }}">{{ ucfirst($o->status) }}</span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('kasir.orders.show', $o) }}" class="text-sm font-semibold text-indigo-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-10 text-center text-gray-400 text-sm">Tidak ada pesanan ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-kasir-layout>