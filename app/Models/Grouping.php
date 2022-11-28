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
        'tahun_akademik',
    ];

    public function rel_siswa(){
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function rel_kelas(){
        return $this->belongsTo(Kelas::class,'id_kelas');
    }
}
