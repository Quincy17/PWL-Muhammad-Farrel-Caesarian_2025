@extends('layouts.template')

@section('content')

@if (Auth::user()->level_id == 5)
    <div class="card">
        <div class="card-header">
        <div class="card-header">
            <h3 class="card-title">Hai, <span style="color:black; font-weight:bold; ">{{ Auth::user()->username }}!, ini adalah halaman utama dari aplikasi ini.</span></h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            Silahkan gunakan aplikasi ini dengan baik :)
        </div>
    </div>
    </div>
@else
<div class="row">
    <!-- Preview Barang -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Jumlah Barang : {{ $totalBarang }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/barang') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Preview Penjualan -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Jumlah User : {{ $totalUser }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/user') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Preview Penjualan Detail -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Jumlah Level : {{ $totalLevel }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/level') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Preview Stok -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Jumlah Stok : {{ $totalStok }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/stok') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Preview Kategori -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Jumlah Kategori : {{ $totalKategori }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/kategori') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Preview Supplier -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Jumlah Supplier : {{ $totalSupplier }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/supplier') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <!-- Preview Penjualan -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Jumlah Penjualan : {{ $totalPenjualan }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/penjualan') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Preview Penjualan Detail -->
    <div class="col-md-4">
        <div class="card text-dark mb-3 text-center">
            <div class="card-header"><h5>Detail Penjualan : {{ $totalPenjualanDetail }}</h5></div>
            <div class="card-body">
                <a href="{{ url('/penjualan_detail') }}" class="btn btn-outline-primary">Lihat Detail</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection