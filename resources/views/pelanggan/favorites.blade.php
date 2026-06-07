<x-pelanggan-layout title="Favorites">
    <div class="px-6 md:px-10 pt-6 md:pt-10 pb-4 md:pb-6 border-b border-gray-100">
        <h2 class="text-[2rem] font-bold text-gray-900 tracking-tight leading-tight">Favorit Anda</h2>
        <p class="text-gray-500 mt-1 text-sm">Pesan ulang menu favorit Anda dengan cepat.</p>
    </div>

    <div class="flex-1 overflow-y-auto custom-scrollbar p-6 md:p-10 flex flex-col items-center justify-center">
        <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Favorit</h3>
        <p class="text-gray-500 text-center max-w-md">Anda belum menambahkan item apa pun ke favorit. Ketuk ikon hati pada menu untuk menyimpannya di sini.</p>
        
        <a href="{{ route('pelanggan.home') }}" class="mt-8 bg-[#112d1e] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#1f4a33] transition-colors">
            Jelajahi Menu
        </a>
    </div>
</x-pelanggan-layout>
