<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'level_id'; // Primary key dari tabel yang digunakan

    protected $fillable = [
        'level_kode',
        'level_nama',
    ]; // Kolom-kolom yang dapat diisi secara massal

    public function user()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    } // Relasi ke model User
}
