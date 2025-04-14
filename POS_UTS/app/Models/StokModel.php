<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    use HasFactory;

    protected $table = 't_stok'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'stok_id'; // Primary key dari tabel yang digunakan

    protected $fillable = [
        'barang_id',
        'supplier_id',
        'user_id',
        'stok_tanggal',
        'stok_jumlah',
    ]; // Kolom-kolom yang dapat diisi secara massal

    public function barang()
     {
         return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
     }
 
     /**
      * Relasi ke model User (m_user)
      */
     public function user()
     {
         return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
     }
 
     /**
      * Relasi ke model Supplier (m_supplier)
      */
     public function supplier()
     {
         return $this->belongsTo(SupplierModel::class, 'supplier_id', 'supplier_id');
     }
}
