@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Proses Pembayaran</h4>
            </div>
            <div class="card-body">
                <h5>Pesanan #{{ $pesanan->id }}</h5>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span>Total Tagihan:</span>
                    <strong class="fs-4 text-danger">Rp{{ number_format($totalHarga, 0, ',', '.') }}</strong>
                </div>

                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pesanan" value="{{ $pesanan->id }}">
                    <input type="hidden" name="total_bayar" value="{{ $totalHarga }}">

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="id_metode" class="form-select" required>
                            <option value="">-- Pilih Metode --</option>
                            @foreach($metode as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_metode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">Bayar Sekarang</button>
                        <a href="{{ route('pesanan.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection