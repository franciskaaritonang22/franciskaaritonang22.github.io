@extends('layouts.app')
@section('content')
<h3>Pesanan #{{ $pesanan->id }}</h3>
<form action="{{ route('detail-pesanan.store') }}" method="POST" class="row g-2 mb-4">
    @csrf
    <input type="hidden" name="id_pesanan" value="{{ $pesanan->id }}">
    <div class="col-md-6">
        <select name="id_menu" class="form-select">
            @foreach($menu as $m)
                <option value="{{ $m->id }}">{{ $m->nama_menu }} - Rp{{ number_format($m->harga) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <input type="number" name="jumlah" class="form-control" value="1">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary w-100">Tambah Item</button>
    </div>
</form>

<table class="table">
    <thead><tr><th>Menu</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr></thead>
    <tbody>
        @foreach($pesanan->detailPesanan as $detail)
        <tr>
            <td>{{ $detail->menu->nama_menu }}</td>
            <td>{{ number_format($detail->menu->harga) }}</td>
            <td>{{ $detail->jumlah }}</td>
            <td>{{ number_format($detail->subtotal) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection