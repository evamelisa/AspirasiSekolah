<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori'; // ← NAMA TABEL ASLI
    protected $fillable = ['nama_kategori'];

    //relasi ke aspirasi
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class);
    }

}
