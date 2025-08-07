<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    protected $table = 'alumni';
    protected $casts = [
        'id' => 'integer',
        'tahun_lulus' => 'integer',
    ];

    protected $fillable = [
        'nama',
        'nis',
        'sex',
        'ttl',
        'bin',
        'tahun_lulus',
        'kelas',
        'status',
    ];

    
}
