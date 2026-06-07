@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-10 text-center md:text-left">
        <h2 class="text-3xl font-bold tracking-tighter uppercase mb-2">Tambah User Baru</h2>
        <div class="h-1 w-12 bg-[#1d3d33] mx-auto md:mx-0"></div>
        <p class="text-xs text-gray-400 mt-4 tracking-widest uppercase">Lengkapi data akun baru keluarga Makecents</p>
    </div>

    <div class="bg-white border border-gray-100 p-8 md:p-12 shadow-sm">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="group">
                <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 group-focus-within:text-[#1d3d33] transition">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Contoh: Budi Santoso" 
                    class="w-full border-b border-gray-200 py-3 outline-none focus:border-[#1d3d33] transition bg-transparent text-sm" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="group">
                    <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 group-focus-within:text-[#1d3d33] transition">Username</label>
                    <input type="text" name="username" placeholder="budisant" 
                        class="w-full border-b border-gray-200 py-3 outline-none focus:border-[#1d3d33] transition bg-transparent text-sm" required>
                </div>
                <div class="group">
                    <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 group-focus-within:text-[#1d3d33] transition">Email</label>
                    <input type="email" name="email" placeholder="budi@email.com" 
                        class="w-full border-b border-gray-200 py-3 outline-none focus:border-[#1d3d33] transition bg-transparent text-sm" required>
                </div>
            </div>

            <div class="group">
                <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 group-focus-within:text-[#1d3d33] transition">Password</label>
                <input type="password" name="password" placeholder="••••••••" 
                    class="w-full border-b border-gray-200 py-3 outline-none focus:border-[#1d3d33] transition bg-transparent text-sm" required>
            </div>

            <div class="group">
                <label class="block text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 group-focus-within:text-[#1d3d33] transition">Role Akses</label>
                <select name="role" class="w-full border-b border-gray-200 py-3 outline-none focus:border-[#1d3d33] bg-transparent text-sm appearance-none cursor-pointer">
                    <option value="pelanggan">Pelanggan</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>

            <div class="pt-8 flex flex-col md:flex-row items-center justify-end space-y-4 md:space-y-0 md:space-x-6">
                <a href="{{ route('users.index') }}" class="text-[11px] font-bold uppercase tracking-widest text-gray-400 hover:text-black transition">
                    Batal
                </a>
                <button type="submit" class="w-full md:w-auto bg-black text-white px-10 py-4 text-[11px] font-bold uppercase tracking-[0.2em] hover:bg-[#1d3d33] transition duration-300">
                    Simpan User
                </button>
            </div>
        </form>
    </div>

    <p class="mt-10 text-center italic text-gray-300 font-light text-sm">"Have a good sense of coffee"</p>
</div>
@endsection