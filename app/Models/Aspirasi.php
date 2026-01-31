<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Models\User;
use App\Models\Kategori;

class Aspirasi extends Model
{
protected $table = 'aspirasi';

protected $fillable = [
    'user_id',
    'kategori_id',
    'title',
    'description',
    'photo',
    'status',
];
 // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class, 'aspirasi_id');
    }
}
