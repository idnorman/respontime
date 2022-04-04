<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = ['nik', 'nama'];

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class, 'pasien_id', 'id');
    }
}
