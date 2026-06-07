<x-admin-layout>
    <x-slot name="title">Edit Menu</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Menu
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit Menu</h1>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 max-w-lg">
        <form method="POST" action="{{ route('admin.menus.update', $menu) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Menu</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e] outline-none transition" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                <input type="number" name="price" value="{{ $menu->price }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e] outline-none transition" required>
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select name="category_id" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e] outline-none transition bg-white">
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ $c->id == $menu->category_id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:border-[#112d1e] focus:ring-1 focus:ring-[#112d1e] outline-none transition bg-white">
                    <option value="tersedia" {{ $menu->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ $menu->status == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar</label>
                @if($menu->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$menu->image) }}" class="w-20 h-20 rounded-xl object-cover border border-gray-200">
                </div>
                @endif
                <input type="file" name="image" class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#112d1e] file:text-white hover:file:bg-[#1a4a30]">
            </div>
            <button type="submit" class="bg-[#112d1e] text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1a4a30] transition-colors shadow-sm">Perbarui Menu</button>
        </form>
    </div>
</x-admin-layout>