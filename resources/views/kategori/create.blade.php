@extends('layouts.app')
@section('content')
<div class="card col-md-6 mx-auto">
    <div class="card-header">Tambah Menu</div>
    <div class="card-body">
        <form action="{{ route('menu.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Menu</label>
                <input type="text" name="nama_menu" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-select">
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <button class="btn btn-success w-100">Simpan Menu</button>
        </form>
    </div>
</div>
@endsection