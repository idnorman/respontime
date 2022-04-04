<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable =['penyakit_id', 'pasien_id', 'status', 'waktu_selesai'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id', 'id');
    }
}
