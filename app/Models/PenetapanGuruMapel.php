<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenetapanGuruMapel extends Model
{
    use HasFactory;

    protected $table = 'penetapan_guru_mapel';

    protected $fillable = [
        'id_tahun',
        'id_kelas',
        'id_mapel',
        'id_guru',
    ];

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mapel()
    {
        return $this->belongsTo(MstMapel::class, 'id_mapel', 'id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_guru', 'id');
    }
}
