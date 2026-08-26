<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPresensiKelas extends Model
{
    use HasFactory;

    protected $table = 'log_presensi_kelas';
    protected $fillable = ['id_kelas', 'tanggal', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
