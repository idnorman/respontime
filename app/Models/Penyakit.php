<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_id', 'nama', 'waktu_minimal', 'waktu_maksimal'];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class, 'penyakit_id', 'id');
    }
}
