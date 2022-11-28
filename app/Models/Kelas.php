<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table='mst_kelas';
    protected $primaryKey='id_kelas';
    protected $fillable=[
        'id_jurusan',
        'tingkat',
        'paralel',
        'nama_kelas',
        'creted_at',
        'updated_at'
    ];

    // public function grouping(){
    //     return $this->hasMany(Grouping::class);
    // }
}
