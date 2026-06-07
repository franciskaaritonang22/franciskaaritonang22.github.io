<x-pelanggan-layout title="Your Orders">
    <div class="px-6 md:px-10 pt-6 md:pt-10 pb-4 md:pb-6 border-b border-gray-100 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
        <div>
            <h2 class="text-[2rem] font-bold text-gray-900 tracking-tight leading-tight">Pesanan Anda</h2>
            <p class="text-gray-500 mt-1 text-sm">Lacak pesanan terbaru dan riwayat pesanan Anda.</p>
        </div>
        <div class="flex gap-2 overflow-x-auto pb-1 md:pb-0" id="filter-buttons">
            <button data-filter="all" class="filter-btn bg-[#112d1e] text-white px-4 py-2 rounded-xl text-sm font-semibold whitespace-nowrap">Semua Pesanan</button>
            <button data-filter="berjalan" class="filter-btn bg-gray-50 text-gray-600 border border-gray-200 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-100 whitespace-nowrap">Berjalan</button>
            <button data-filter="selesai" class="filter-btn bg-gray-50 text-gray-600 border border-gray-200 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-100 whitespace-nowrap">Selesai</button>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto custom-scrollbar p-6 md:p-10">
        @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $o)
            @php
                $statusLower = strtolower($o->status);
                $isSelesai = in_array($statusLower, ['selesai', 'dibatalkan', 'ditolak']);
                $filterCategory = $isSelesai ? 'selesai' : 'berjalan';
            @endphp
            <div class="order-card bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow" data-category="{{ $filterCategory }}">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#112d1e]/10 text-[#112d1e] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Pesanan #{{ $o->kode_order }}</h4>
                            <p class="text-xs text-gray-500">{{ $o->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <div>
                        <span class="px-3 py-1 bg-[#112d1e]/10 text-[#112d1e] rounded-lg font-bold text-xs uppercase tracking-wider">
                            {{ $o->status }}
                        </span>
                    </div>
                </div>
                
                <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Tagihan</p>
                        <p class="font-bold text-gray-900 text-lg">Rp {{ number_format($o->total_price, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('pelanggan.orders.show', $o) }}" class="text-[#112d1e] font-semibold text-sm hover:underline flex items-center gap-1">
                        Lihat Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-20">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6 border border-gray-100">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500 text-center max-w-md">Anda belum membuat pesanan. Mulai jelajahi menu kami untuk membuat pesanan pertama Anda.</p>
            <a href="{{ route('pelanggan.home') }}" class="mt-8 bg-[#112d1e] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#1f4a33] transition-colors">
                Pesan Sekarang
            </a>
        </div>
        @endif
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.order-card');

        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update button styles
                buttons.forEach(b => {
                    b.className = 'filter-btn bg-gray-50 text-gray-600 border border-gray-200 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-100';
                });
                this.className = 'filter-btn bg-[#112d1e] text-white px-4 py-2 rounded-xl text-sm font-semibold';

                const filter = this.dataset.filter;

                // Filter cards
                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>
</x-pelanggan-layout>