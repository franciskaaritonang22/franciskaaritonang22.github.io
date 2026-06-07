<x-pelanggan-layout title="Hadiah & Loyalitas">
    <div class="px-6 md:px-10 pt-6 md:pt-10 pb-4 md:pb-6 border-b border-gray-100">
        <h2 class="text-[2rem] font-bold text-gray-900 tracking-tight leading-tight">Hadiah Anda</h2>
        <p class="text-gray-500 mt-1 text-sm">Kumpulkan poin dari setiap pesanan dan tukarkan dengan promo menarik!</p>
    </div>

    <div class="flex-1 overflow-y-auto custom-scrollbar p-6 md:p-10">
        <!-- Points Dashboard -->
        <div class="bg-[#112d1e] rounded-[2rem] p-8 text-white mb-10 shadow-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-20 -mt-20"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <p class="text-white/60 text-xs font-bold uppercase tracking-widest mb-2">Total Poin Saat Ini</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-6xl font-black">{{ auth()->user()->points ?? 0 }}</span>
                        <span class="text-xl font-bold opacity-60">Poin</span>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10 flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-400 rounded-xl flex items-center justify-center text-[#112d1e]">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-white/70 uppercase">Status Member</p>
                        <p class="text-lg font-bold">Gold Member 🏆</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Info Section -->
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Cara Mendapatkan Poin</h3>
                <ul class="space-y-4">
                    <li class="flex gap-4">
                        <div class="w-6 h-6 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xs font-bold shrink-0">1</div>
                        <p class="text-sm text-gray-600 leading-relaxed">Setiap pembelanjaan <span class="font-bold text-gray-900">Rp 1.000</span> akan mendapatkan <span class="font-bold text-gray-900">1 Poin</span>.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="w-6 h-6 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xs font-bold shrink-0">2</div>
                        <p class="text-sm text-gray-600 leading-relaxed">Poin akan otomatis ditambahkan setelah pesanan Anda <span class="font-bold text-gray-900">selesai dikonfirmasi</span> oleh kasir.</p>
                    </li>
                    <li class="flex gap-4">
                        <div class="w-6 h-6 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-xs font-bold shrink-0">3</div>
                        <p class="text-sm text-gray-600 leading-relaxed">Poin dapat ditukarkan dengan berbagai menu gratis atau diskon eksklusif.</p>
                    </li>
                </ul>
            </div>

            <!-- Placeholder for Future Rewards -->
            <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-[2rem] p-8 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Penukaran Hadiah</h3>
                <p class="text-sm text-gray-500 max-w-xs">Fitur penukaran poin sedang dalam pengembangan. Kumpulkan poin Anda sekarang!</p>
            </div>
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('pelanggan.home') }}" class="inline-flex items-center gap-2 bg-[#112d1e] text-white px-8 py-4 rounded-2xl font-bold hover:bg-[#1f4a33] transition-all hover:scale-105 active:scale-95 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Pesan Sekarang & Cari Poin
            </a>
        </div>
    </div>
</x-pelanggan-layout>
