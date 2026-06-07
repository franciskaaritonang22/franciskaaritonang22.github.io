@extends('layouts.app')

@section('content')
<div class="mb-12">
    <h2 class="text-3xl font-bold tracking-tighter uppercase mb-2">Our Menu</h2>
    <div class="h-1 w-12 bg-makecents-green"></div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
    @foreach($menus as $menu)
    <div class="group bg-white border border-gray-100 rounded-sm overflow-hidden hover:shadow-xl transition-all duration-300">
        <div class="aspect-square bg-gray-200 overflow-hidden relative">
            <img src="{{ asset('storage/' . $menu->image) }}" class="object-cover w-full h-full group-hover:scale-105 transition">
            <div class="absolute top-2 right-2 bg-white/90 px-3 py-1 text-[10px] font-bold uppercase">
                {{ $menu->kategori->nama }}
            </div>
        </div>
        <div class="p-5">
            <h3 class="font-bold text-sm uppercase tracking-tight mb-1">{{ $menu->nama_menu }}</h3>
            <p class="text-xs text-gray-500 mb-4 h-8 overflow-hidden">{{ $menu->deskripsi }}</p>
            <div class="flex justify-between items-center">
                <span class="font-bold text-sm">Rp {{ number_format($menu->harga) }}</span>
                <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                    @csrf
                    <button class="bg-makecents-green text-white text-[10px] font-bold uppercase px-4 py-2 hover:bg-black transition">
                        Tambah +
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection