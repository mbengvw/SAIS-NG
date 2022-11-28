<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'mst_siswa';
    protected $primaryKey = 'id_siswa';
    protected $fillable=[
        'no_daftar',
        'nis',
        'nisn',
        'nama_lengkap',
        'jk',
        'angkatan',
        'jalur',
        'asal_sltp'
    ];

    // public function rel_grouping(){
    //     return $this->belongsTo(Grouping::class);
    // }
}
