<x-admin-layout>
    <x-slot name="title">Edit Kategori</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Kategori
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit Kategori</h1>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 max-w-lg">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" value="{{ $category->name }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e] outline-none transition" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-[#112d1e] text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1a4a30] transition-colors shadow-sm">Perbarui Kategori</button>
        </form>
    </div>
</x-admin-layout>