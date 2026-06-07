<x-admin-layout>
    <x-slot name="title">Kasir</x-slot>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Kasir</h1>
        <p class="text-sm text-gray-500 mt-1">Perbarui email dan kata sandi kasir</p>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm mb-5">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-5">
        @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
    </div>
    @endif

    <div class="space-y-4">
        @foreach($kasirs as $kasir)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <form action="{{ route('admin.kasirs.update', $kasir) }}" method="POST">
                @csrf @method('PUT')
                <div class="flex flex-col md:flex-row items-start gap-5">
                    <!-- Avatar -->
                    <div class="w-12 h-12 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm shrink-0">
                        {{ strtoupper(substr($kasir->name, 0, 2)) }}
                    </div>
 
                    <!-- Form Fields -->
                    <div class="flex-1 w-full grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Nama</label>
                            <input type="text" name="name" value="{{ $kasir->name }}" class="w-full border border-gray-200 rounded-xl px-3.5 py-2 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ $kasir->email }}" class="w-full border border-gray-200 rounded-xl px-3.5 py-2 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1.5">Kata Sandi Baru <span class="text-gray-300">(opsional)</span></label>
                            <input type="password" name="password" placeholder="Biarkan kosong untuk mempertahankan" class="w-full border border-gray-200 rounded-xl px-3.5 py-2 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                        </div>
                    </div>
 
                    <div class="flex items-center gap-2 shrink-0 pt-0 md:pt-5 w-full md:w-auto">
                        <button type="submit" class="w-full md:w-auto bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-800 transition-colors text-center">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <!-- Status Toggle (separate form) -->
            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $kasir->status ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                        {{ $kasir->status ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <span class="text-xs text-gray-400">Bergabung {{ $kasir->created_at->format('d M Y') }}</span>
                </div>
                <form action="{{ route('admin.kasirs.toggle', $kasir) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="text-sm font-semibold {{ $kasir->status ? 'text-red-500 hover:underline' : 'text-emerald-600 hover:underline' }}">
                        {{ $kasir->status ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</x-admin-layout>
