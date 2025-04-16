<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id';  // Mendefinisikan primary key dari tabel yang digunakan

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
    ]; // Kolom-kolom yang dapat diisi secara massal

    protected $hidden = ['password'];
 
    protected $casts = ['password' => 'hashed'];

    public function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    // Relasi dengan tabel stok
    public function stok()
    {
        return $this->hasMany(StokModel::class, 'user_id', 'user_id');
    }
    // Relasi dengan tabel penjualan
    public function penjualan(){
        return $this->hasMany(PenjualanModel::class, 'user_id', 'user_id');
    }

    public function getRoleName(): String{
        return $this->level->level_nama;
    }

    public function hasRole ($role): bool{
        return $this->level->level_kode == $role;
    }

    public function getRole (){
        return $this->level->level_kode;
    }
}