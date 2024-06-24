<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'nisn',
        'nik',
        'tahun_masuk',
        'tempat_lahir',
        'tgl_lahir',
        'status',
        'jenis_kelamin',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'nama_wali'
    ];

    public function grouping()
    {
        // return $this->hasMany(Grouping::class, 'foreign_key', 'local_key');
        return $this->hasMany(Grouping::class, 'id_siswa', 'id');
    }
}
