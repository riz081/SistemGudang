<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'tanggal', 
        'jenis_mutasi', 
        'jumlah', 
        'user_id', 
        'barang_id',
    ];
}
