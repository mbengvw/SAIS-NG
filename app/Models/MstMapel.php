<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstMapel extends Model
{
    use HasFactory;

    protected $table = 'mst_mapel';

    protected $fillable = [
        'nama_mapel',
        'tingkat',
        'jurusan',
        'deskripsi',
    ];

    public function penetapanGuruMapel()
    {
        return $this->hasMany(PenetapanGuruMapel::class, 'id_mapel', 'id');
    }
}
