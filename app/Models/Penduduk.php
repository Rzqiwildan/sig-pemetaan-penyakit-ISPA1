<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'pemetaan_ispa_id',
        'nama',
        'umur',
        'jenis_kelamin',
        'alamat'
    ];

    // Relasi ke PemetaanIspa
    public function pemetaanIspa()
{
    return $this->belongsTo(PemetaanIspa::class, 'pemetaan_ispa_id');
}
}