<x-admin-layout>
    <x-slot name="title">Edit Promo</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.promos.index') }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-gray-900 transition mb-2">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Promo: {{ $promo->code }}</h1>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin.promos.update', $promo) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Kode Promo</label>
                    <input type="text" name="code" value="{{ old('code', $promo->code) }}" required 
                           class="w-full border-gray-200 rounded-xl px-4 py-2 text-sm focus:border-[#112d1e] focus:ring-[#112d1e] transition">
                    @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Potongan</label>
                        <input type="number" name="discount" value="{{ old('discount', $promo->discount) }}" required
                               class="w-full border-gray-200 rounded-xl px-4 py-2 text-sm focus:border-[#112d1e] focus:ring-[#112d1e] transition">
                        @error('discount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tipe Potongan</label>
                        <select name="type" required class="w-full border-gray-200 rounded-xl px-4 py-2 text-sm focus:border-[#112d1e] focus:ring-[#112d1e] transition bg-white">
                            <option value="fixed" {{ $promo->type === 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
                            <option value="percentage" {{ $promo->type === 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                        </select>
                        @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Berlaku Hingga (Opsional)</label>
                    <input type="datetime-local" name="expires_at" value="{{ old('expires_at', $promo->expires_at ? \Carbon\Carbon::parse($promo->expires_at)->format('Y-m-d\TH:i') : '') }}"
                           class="w-full border-gray-200 rounded-xl px-4 py-2 text-sm focus:border-[#112d1e] focus:ring-[#112d1e] transition">
                    @error('expires_at') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" id="is_active" {{ $promo->is_active ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#112d1e] focus:ring-[#112d1e]">
                    <label for="is_active" class="text-sm font-bold text-gray-700 cursor-pointer">Promo Aktif</label>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <button type="submit" class="bg-[#112d1e] text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-[#1a4a30] transition shadow-md">
                    Update Promo
                </button>
                <a href="{{ route('admin.promos.index') }}" class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
