<x-admin-layout>
    <x-slot name="title">Laporan</x-slot>

    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan Analitik</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau performa pendapatan dan pesanan Cafe Anda</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.reports.pdf', request()->query()) }}" class="inline-flex items-center px-5 py-2.5 bg-red-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Cetak PDF
            </a>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e]">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e]">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">Status Pesanan</label>
                <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e] bg-white">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-[#112d1e] text-white py-2 rounded-xl text-sm font-bold hover:bg-[#1a4a30] transition shadow-sm">
                    Filter
                </button>
                <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-sm font-bold hover:bg-gray-200 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Analytics Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Revenue -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:border-emerald-200 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
            <h3 class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:border-blue-200 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Pesanan</p>
            <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $totalOrders }} <span class="text-xs text-gray-400 font-normal">Pesanan</span></h3>
        </div>

        <!-- Pending Count -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:border-amber-200 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Menunggu/Proses</p>
            <h3 class="text-xl font-bold text-gray-900 mt-1">{{ $pendingCount }} <span class="text-xs text-gray-400 font-normal">Pesanan</span></h3>
        </div>

        <!-- Avg Order Value -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:border-indigo-200 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 01-2 2h2a2 2 0 012-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Rata-rata Pesanan</p>
            <h3 class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($avgOrderValue, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
            <h2 class="text-xs font-bold text-gray-900 uppercase tracking-widest">Rincian Riwayat Pesanan</h2>
            <span class="text-[10px] bg-white border border-gray-200 text-gray-500 px-3 py-1 rounded-full font-bold shadow-sm">{{ count($orders) }} Pesanan Ditemukan</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left">
                <thead class="bg-white text-[10px] text-gray-400 uppercase tracking-widest font-bold border-b border-gray-50">
                    <tr>
                        <th class="px-6 py-4">ID Pesanan</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Total Harga</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($orders as $o)
                    <tr class="hover:bg-gray-50/30 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">#{{ $o->kode_order ?? $o->id }}</td>
                        <td class="px-6 py-4 text-xs text-gray-500">{{ $o->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-xs text-gray-600 font-medium">{{ $o->user->name ?? 'Tamu' }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-900">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = match($o->status) {
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'diproses' => 'bg-blue-100 text-blue-700',
                                    'selesai' => 'bg-emerald-100 text-emerald-700',
                                    'dibatalkan' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-600'
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider {{ $statusClasses }}">
                                {{ $o->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-sm text-gray-400">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <p class="font-medium text-gray-500">Tidak ada pesanan ditemukan</p>
                                <p class="text-xs text-gray-400 mt-1">Coba sesuaikan filter tanggal atau status Anda</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>