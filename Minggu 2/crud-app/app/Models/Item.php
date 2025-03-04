<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    //Biar ga error MassAssignmentException. ntar malah ke web laravel, bukan kembali ke web awal buat nampilin data
    protected $fillable = [
        'name',
        'description',
    ];
}
