<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grouping extends Model
{
    use HasFactory;
    protected $table = 'tst_grouping';
    protected $primaryKey = 'id_grouping';
    protected $fillable=[
        'id_siswa',
        'id_kelas',
        'id_tahun',
    ];

    public function siswa(){
        // return $this->belongsTo(Siswa::class, 'foreign_key');
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class,'id_kelas');
    }

    public function presensi(){
        // return $this->hasMany(Grouping::class, 'foreign_key', 'local_key');
        return $this->hasMany(Presensi::class,'id_grouping','id_presensi');
    }
}
