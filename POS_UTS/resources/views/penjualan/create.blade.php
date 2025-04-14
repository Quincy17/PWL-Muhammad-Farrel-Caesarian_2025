@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ url('penjualan') }}" method="POST" class="form-horizontal">
            @csrf
        
            <div class="form-group row">
                <label class="col-2 col-form-label" for="penjualan_tanggal">Tanggal</label>
                <div class="col-10">
                    <input type="date" name="penjualan_tanggal" class="form-control" value="{{ old('penjualan_tanggal') }}" required>
                    @error('penjualan_tanggal')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        
            <div class="form-group row">
                <label class="col-2 col-form-label">User</label>
                <div class="col-10">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">- Pilih User -</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->user_id }}">{{ $user->username }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>            
        
            <div class="form-group row">
                <label class="col-2 col-form-label" for="penjualan_kode">Kode Penjualan</label>
                <div class="col-10">
                    <input type="text" name="penjualan_kode" class="form-control" value="{{ old('penjualan_kode') }}" required>
                    @error('penjualan_kode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        
            <div class="form-group row">
                <label class="col-2 col-form-label" for="pembeli">Pembeli</label>
                <div class="col-10">
                    <input type="text" name="pembeli" class="form-control" value="{{ old('pembeli') }}" required>
                    @error('pembeli')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection
