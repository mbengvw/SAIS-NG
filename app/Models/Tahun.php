<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $table = 'mst_tahun';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tahun',
        'semester',
        'alias_tahun',
        'is_active',
    ];
}
