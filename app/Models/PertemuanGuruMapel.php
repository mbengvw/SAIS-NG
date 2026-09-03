<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertemuanGuruMapel extends Model
{
    use HasFactory;

    protected $table = 'trx_pertemuan_guru_mapel';
    protected $fillable = ['id_penetapan', 'tanggal', 'materi_pembelajaran'];

    public function catatan()
    {
        return $this->hasMany(CatatanPembelajaran::class, 'id_pertemuan');
    }

    public function penetapan()
    {
        return $this->belongsTo(PenetapanGuruMapel::class, 'id_penetapan');
    }
}
