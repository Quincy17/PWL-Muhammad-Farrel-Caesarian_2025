@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/penjualan/import') }}')" class="btn btn-sm btn-info mt-1">Import Penjualan</button>
            <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-sm btn-primary mt-1"><i class="fa fa-fileexcel"></i> Export Penjualan (Excel)</a>
            <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-sm mt-1 btn-warning"><i class="fa fa-filepdf"></i> Export Penjualan (PDF)</a>
            <button onclick="modalAction('{{ url('penjualan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                    <th>Kode Penjualan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        var dataUser;
$(document).ready(function () {
    dataUser = $('#table_penjualan').DataTable({
        serverSide: true,
        ajax: {
            url: "{{ url('penjualan/list') }}", // route untuk ambil data JSON
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}"
            }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
            { data: 'penjualan_tanggal' },
            { data: 'pembeli' },
            { data: 'penjualan_kode' },
            { data: 'aksi', orderable: false, searchable: false, className: 'text-center' }
        ]
    });
});
</script>
@endpush
