<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;
    protected $table = 'tst_pelanggaran';
    protected $primaryKey = 'id_pelanggaran';
    protected $fillable = [
        'id_hukdis',
        'id_grouping',
        'tanggal',
        'semester',
        'id_petugas',
    ];
}
