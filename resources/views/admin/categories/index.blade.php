<x-admin-layout>
    <x-slot name="title">Kategori</x-slot>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kategori</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola kategori menu Anda</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 bg-[#112d1e] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#1a4a30] transition-colors shadow-sm w-full sm:w-auto justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm mb-5">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] text-left">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($categories as $i => $c)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-3.5 text-sm text-gray-400">{{ $i + 1 }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900">{{ $c->name }}</td>
                        <td class="px-5 py-3.5 text-right">
                            <a href="{{ route('admin.categories.edit', $c) }}" class="text-sm text-[#112d1e] font-semibold hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $c) }}" class="inline ml-3">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 font-semibold hover:underline" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>