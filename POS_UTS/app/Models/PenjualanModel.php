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

    public function user()
    {
        return $this->hasMany(UserModel::class, 'user_id', 'user_id');
    } // Relasi ke model User

    public function detail()
    {
        return $this->hasMany(PenjualanDetailModel::class, 'penjualan_id', 'penjualan_id');
    }
}
