<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table='tst_kehadiran';
    protected $primaryKey='id_kehadiran';
    protected $fillable=[
        'id_grouping',
        'semester',
        'tanggal',
        'status',
        'keterangan',
        'creted_at',
        'updated_at'
    ];

    public function grouping(){
        // return $this->belongsTo(Siswa::class, 'foreign_key');
        return $this->belongsTo(Grouping::class, 'id_grouping');
    }
}

