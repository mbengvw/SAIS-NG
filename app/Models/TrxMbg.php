<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxMbg extends Model
{
    use HasFactory;

    protected $table = 'trx_mbg';

    protected $fillable = [
        'id_kelas',
        'tanggal',
        'jumlah_hadir',
        'jumlah_diambil',
        'waktu_diambil',
        'nama_pengambil',
        'jumlah_kembali',
        'waktu_kembali',
        'status',
        'keterangan',
        'id_user_piket',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function userPiket()
    {
        return $this->belongsTo(User::class, 'id_user_piket');
    }
}
