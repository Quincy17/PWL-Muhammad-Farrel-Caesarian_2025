@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($detail)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('penjualan_detail') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ url('penjualan_detail/'.$detail->detail_id) }}" class="form-horizontal">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-2 col-form-label">ID Penjualan</label>
                <div class="col-10">
                    <input type="number" name="penjualan_id" class="form-control" value="{{ old('penjualan_id', $detail->penjualan_id) }}" required>
                    @error('penjualan_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">ID Barang</label>
                <div class="col-10">
                    <input type="number" name="barang_id" class="form-control" value="{{ old('barang_id', $detail->barang_id) }}" required>
                    @error('barang_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">Harga</label>
                <div class="col-10">
                    <input type="number" name="harga" class="form-control" value="{{ old('harga', $detail->harga) }}" required>
                    @error('harga')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">Jumlah</label>
                <div class="col-10">
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $detail->jumlah) }}" required>
                    @error('jumlah')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ url('penjualan_detail') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                </div>
            </div>
        </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
