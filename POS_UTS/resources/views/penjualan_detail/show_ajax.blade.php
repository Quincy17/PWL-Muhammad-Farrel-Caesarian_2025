@empty($penjualanDetail)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <button type="button" data-dismiss="modal" class="btn btn-warning">Tutup</button>
        </div>
    </div>
</div>
@else
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Data Transaksi Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID Penjualan Detail</th>
                    <td>{{ $penjualanDetail->detail_id }}</td>
                </tr>
                <tr>
                    <th>ID Penjualan</th>
                    <td>{{ $penjualanDetail->penjualan_id }}</td>
                </tr>
                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $penjualanDetail->barang->barang_nama }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>{{ $penjualanDetail->harga }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $penjualanDetail->jumlah }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>{{ $penjualanDetail->harga * $penjualanDetail->jumlah }}</td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-warning">Tutup</button>
        </div>
    </div>
</div>
@endempty