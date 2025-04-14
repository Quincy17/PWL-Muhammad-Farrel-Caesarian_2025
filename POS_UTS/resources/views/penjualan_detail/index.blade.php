@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan_detail/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan_detail">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Penjualan</th>
                    <th>ID Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
$(document).ready(function () {
    $('#table_penjualan_detail').DataTable({
        serverSide: true,
        ajax: {
            url: "{{ url('penjualan_detail/list') }}", // ← sesuai dengan prefix route
            type: "POST",
            dataType: "json"
        },
        columns: [
            {
                data: 'DT_RowIndex',
                className: 'text-center',
                orderable: false,
                searchable: false
            },
            {
                data: 'penjualan_id',
                orderable: true,
                searchable: true
            },
            {
                data: 'barang_id',
                orderable: true,
                searchable: true
            },
            {
                data: 'harga',
                orderable: true,
                searchable: true
            },
            {
                data: 'jumlah',
                orderable: true,
                searchable: true
            },
            {
                data: 'aksi',
                orderable: false,
                className: "text-center",
                searchable: false
            }
        ]
    });
});
</script>
@endpush
