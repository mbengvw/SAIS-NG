<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPembelajaran extends Model
{
    use HasFactory;

    protected $table = 'trx_catatan_pembelajaran';
    protected $fillable = ['id_pertemuan', 'id_siswa', 'catatan'];

    public function pertemuan()
    {
        return $this->belongsTo(PertemuanGuruMapel::class, 'id_pertemuan');
    }

    public function siswa()
    {
        return $this->belongsTo(Student::class, 'id_siswa', 'id');
    }
}
