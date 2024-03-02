<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'mst_kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = [
        'id_tahun',
        'tahun',
        'jurusan',
        'tingkat',
        'paralel',
        'nama_kelas',
        'creted_at',
        'updated_at'
    ];

    public function grouping()
    {
        // return $this->hasMany(Grouping::class, 'foreign_key', 'local_key');
        return $this->hasMany(Grouping::class, 'id_kelas', 'id_grouping');
    }
}
