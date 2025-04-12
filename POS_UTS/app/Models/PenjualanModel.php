<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'penjualan_id'; // Primary key dari tabel yang digunakan
    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal',
    ]; // Kolom-kolom yang dapat diisi secara massal
}
