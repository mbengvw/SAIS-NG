<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxIzinKeluar extends Model
{
    use HasFactory;

    protected $table = 'trx_izin_keluar';

    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'tanggal',
        'waktu_keluar',
        'waktu_kembali',
        'alasan',
        'id_guru_pemberi',
        'id_user_piket_keluar',
        'id_user_piket_kembali',
        'is_pulang',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Student::class, 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function guruPemberi()
    {
        return $this->belongsTo(User::class, 'id_guru_pemberi');
    }

    public function piketKeluar()
    {
        return $this->belongsTo(User::class, 'id_user_piket_keluar');
    }

    public function piketKembali()
    {
        return $this->belongsTo(User::class, 'id_user_piket_kembali');
    }
}
