@extends('layouts.app')

@section('content')
<div class="mb-10 flex justify-between items-end">
    <div>
        <h2 class="text-3xl font-bold tracking-tighter uppercase mb-2">Manajemen User</h2>
        <div class="h-1 w-12 bg-[#1d3d33]"></div>
    </div>
    
    <a href="{{ route('users.create') }}" class="bg-black text-white text-[11px] font-bold uppercase tracking-widest px-6 py-3 rounded-full hover:bg-gray-800 transition">+ Tambah User Baru
    </a>
</div>

<div class="bg-white border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">ID</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Username</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Email</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500">Role</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50/50 transition">
                <td class="px-6 py-4 text-sm text-gray-400 font-mono">#{{ $user->id_user }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->nama }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-[9px] font-bold uppercase tracking-widest rounded-full {{ $user->role == 'admin' ? 'bg-black text-white' : 'bg-gray-100 text-gray-600' }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex justify-center space-x-3">
                        <a href="{{ route('users.edit', $user->id_user) }}" class="text-[10px] font-bold uppercase border-b border-black hover:text-gray-400 hover:border-gray-400 transition">Edit</a>
                        <form action="{{ route('users.destroy', $user->id_user) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-[10px] font-bold uppercase text-red-600 border-b border-red-600 hover:text-red-400 hover:border-red-400 transition">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-20 text-center text-gray-400 italic">Belum ada data user.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if(session('success'))
    <div class="mb-6 p-4 bg-[#1d3d33] text-white text-xs font-bold uppercase tracking-widest">
        {{ session('success') }}
    </div>
@endif
@endsection