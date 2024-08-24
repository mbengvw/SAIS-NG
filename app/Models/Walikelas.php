<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    use HasFactory;
    protected $table = 'walikelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tahun',
        'id_kelas',
        'id_user',
        'tahun',
    ];
}
