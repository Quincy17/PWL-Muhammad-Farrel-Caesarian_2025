@extends('layouts.template')
 
 @section('content')
     <div class="card card-outline card-primary">
         <div class="card-header">
             <h3 class="card-title">{{ $page->title }}</h3>
             <div class="card-tools">
                 <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
                 <button onclick="modalAction('{{ url('stok/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
                </div>
         </div>
         <div class="card-body">
             {{-- Alert untuk Success --}}
             @if (session('success'))
                 <div class="alert alert-success">{{ session('success') }}</div>
             @endif
 
             {{-- Alert untuk Error --}}
             @if (session('error'))
                 <div class="alert alert-danger">{{ session('error') }}</div>
             @endif
 
             {{-- Filtering --}}
             <div class="row">
                 <div class="col-md-12">
                     <div class="form-group row">
                         <label class="col-1 control-label col-form-label">Filter:</label>
                         <div class="col-3">
                             <select class="form-control" id="barang_id" name="barang_id">
                                 <option value="">- Semua Barang -</option>
                                 @foreach($barang as $item)
                                     <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                 @endforeach
                             </select>
                             <small class="form-text text-muted">Nama Barang</small>
                         </div>
 
                         <div class="col-3">
                             <select class="form-control" id="supplier_id" name="supplier_id">
                                 <option value="">- Semua Supplier -</option>
                                 @foreach($supplier as $item)
                                     <option value="{{ $item->supplier_id }}">{{ $item->supplier_nama }}</option>
                                 @endforeach
                             </select>
                             <small class="form-text text-muted">Supplier</small>
                         </div>
                     </div>
                 </div>
             </div>
 
             <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                 <thead>
                     <tr>
                         <th>ID</th>
                         <th>Kode Barang</th>
                         <th>Nama Barang</th>
                         <th>Supplier</th>
                         <th>Jumlah</th>
                         <th>Tanggal</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
             </table>
         </div>
     </div>
     <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"data-keyboard="false" data-width="75%" aria-hidden="true"></div>
 @endsection
 
 @push('css')
 @endpush
 
 @push('js')
     <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }
         $(document).ready(function() {
             var dataStok = $('#table_stok').DataTable({
                 serverSide: true,
                 ajax: {
                     "url": "{{ url('stok/list') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data": function(d) {
                         d.barang_id = $('#barang_id').val();
                         d.supplier_id = $('#supplier_id').val();
                     }
                 },
                 columns: [
                     { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                     { data: "barang.barang_kode", className: "", orderable: true, searchable: true },
                     { data: "barang.barang_nama", className: "", orderable: true, searchable: true },
                     { data: "supplier.supplier_nama", className: "", orderable: true, searchable: true },
                     { data: "stok_jumlah", className: "text-center", orderable: true, searchable: false },
                     { data: "stok_tanggal", className: "text-center", orderable: true, searchable: false },
                     { data: "aksi", className: "text-center", orderable: false, searchable: false }
                 ]
             });
 
             $('#barang_id, #supplier_id').on('change', function() {
                 dataStok.ajax.reload();
             });
         });
     </script>
 @endpush