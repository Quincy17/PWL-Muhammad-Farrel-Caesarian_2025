@extends('layouts.app')

@section('subtitle', 'Edit Kategori')
@section('content_header_title', 'Edit Kategori')
@section('content_header_subtitle', 'Perbarui Data Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit Kategori</div>
            <div class="card-body">
                <form action="{{ route('kategori.update', $kategori->kategori_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="kategori_kode" class="form-label">Kode Kategori</label>
                        <input type="text" name="kategori_kode" class="form-control" value="{{ $kategori->kategori_kode }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_nama" class="form-label">Nama Kategori</label>
                        <input type="text" name="kategori_nama" class="form-control" value="{{ $kategori->kategori_nama }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
