<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'm_supplier'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'supplier_id'; // Primary key dari tabel yang digunakan
    protected $fillable = [
        'supplier_kode',
        'supplier_nama',
        'supplier_alamat',
        'sektor',
    ]; // Kolom-kolom yang dapat diisi secara massal

    public function stok()
     {
         return $this->hasMany(StokModel::class, 'supplier_id', 'supplier_id');
     }
}
