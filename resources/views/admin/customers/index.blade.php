<x-admin-layout>
    <x-slot name="title">Pelanggan</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Pelanggan</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola pelanggan terdaftar</p>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm mb-5">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3 font-semibold">#</th>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold">Email</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($customers as $i => $c)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-3.5 text-sm text-gray-400">{{ $i + 1 }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900">{{ $c->name }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-600">{{ $c->email }}</td>
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $c->status ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $c->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5 text-right">
                            <form method="POST" action="{{ route('admin.customers.update', $c) }}" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="{{ $c->status ? 0 : 1 }}">
                                <button type="submit" class="text-sm font-semibold {{ $c->status ? 'text-red-500 hover:underline' : 'text-emerald-600 hover:underline' }}">
                                    {{ $c->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>