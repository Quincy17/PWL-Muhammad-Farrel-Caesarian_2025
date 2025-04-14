@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form action="{{ url('penjualan_detail') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-2 col-form-label">ID Penjualan</label>
                <div class="col-10">
                    <input type="number" name="penjualan_id" class="form-control" required>
                    @error('penjualan_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">ID Barang</label>
                <div class="col-10">
                    <input type="number" name="barang_id" class="form-control" required>
                    @error('barang_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">Harga</label>
                <div class="col-10">
                    <input type="number" name="harga" class="form-control" required>
                    @error('harga')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">Jumlah</label>
                <div class="col-10">
                    <input type="number" name="jumlah" class="form-control" required>
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
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
