<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetailModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan_detail'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'detail_id'; // Primary key dari tabel yang digunakan
    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'jumlah',
        'harga',
    ]; // Kolom-kolom yang dapat diisi secara massal
}
