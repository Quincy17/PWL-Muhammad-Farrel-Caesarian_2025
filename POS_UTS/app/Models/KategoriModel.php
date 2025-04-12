<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'kategori_id'; // Primary key dari tabel yang digunakan

    protected $fillable = [
        'kategori_kode',
        'kategori_nama',
    ]; // Kolom-kolom yang dapat diisi secara massal
}
