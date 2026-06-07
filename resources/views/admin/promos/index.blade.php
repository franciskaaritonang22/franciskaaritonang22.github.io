<x-admin-layout>
    <x-slot name="title">Manajemen Promo</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Promo</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola kode promo dan diskon harga</p>
        </div>
        <div>
            <a href="{{ route('admin.promos.create') }}" class="inline-flex items-center px-4 py-2 bg-[#112d1e] border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-[#1a4a30] transition shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Promo
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left">
                <thead class="bg-gray-50 text-[10px] text-gray-400 uppercase tracking-widest font-bold">
                    <tr>
                        <th class="px-6 py-4">Kode Promo</th>
                        <th class="px-6 py-4">Potongan</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Berlaku Hingga</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($promos as $promo)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-900">
                            <span class="bg-gray-100 px-2 py-1 rounded border border-gray-200">{{ $promo->code }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                            {{ $promo->type === 'percentage' ? $promo->discount . '%' : 'Rp ' . number_format($promo->discount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500 capitalize">{{ $promo->type }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.promos.toggle', $promo) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $promo->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-500">
                            {{ $promo->expires_at ? \Carbon\Carbon::parse($promo->expires_at)->format('d M Y, H:i') : 'Selamanya' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.promos.edit', $promo) }}" class="p-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.promos.destroy', $promo) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-400">
                            Belum ada promo yang ditambahkan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
