<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $table = 'nilai_siswa';

    protected $fillable = [
        'id_komponen',
        'id_siswa',
        'nilai',
        'catatan',
    ];

    protected $casts = [
        'nilai' => 'float',
    ];

    public function komponen()
    {
        return $this->belongsTo(KomponenNilai::class, 'id_komponen');
    }

    public function siswa()
    {
        return $this->belongsTo(Student::class, 'id_siswa');
    }
}
