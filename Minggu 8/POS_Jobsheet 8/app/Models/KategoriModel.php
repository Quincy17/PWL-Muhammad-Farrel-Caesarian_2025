<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = 'm_kategori';
    protected $primaryKey = 'kategori_id';
    public $timestamps = false;

    protected $fillable = [
        'kategori_kode',
        'kategori_nama',
    ];

    // Relasi ke Barang
    public function barang()
    {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }
}