<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenNilai extends Model
{
    use HasFactory;

    protected $table = 'komponen_nilai';

    protected $fillable = [
        'id_penetapan',
        'nama_komponen',
        'jenis',
        'bobot',
        'urutan',
    ];

    public function penetapan()
    {
        return $this->belongsTo(PenetapanGuruMapel::class, 'id_penetapan');
    }

    public function nilaiSiswa()
    {
        return $this->hasMany(NilaiSiswa::class, 'id_komponen');
    }
}
