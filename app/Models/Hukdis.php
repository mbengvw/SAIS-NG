<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hukdis extends Model
{
    use HasFactory;
    protected $table='mst_hukdis';
    protected $primaryKey='id_hukdis';
    protected $fillable=[
        'deskripsi',
        'poin',
        'created_at',
        'updated_at',
    ];
}
