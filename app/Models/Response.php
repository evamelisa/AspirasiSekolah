<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    // Nama tabel (sesuaikan dengan migration kamu)
    protected $table = 'responses';

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'user_id',
        'aspirasi_id',
        'message',
    ];

    // Relasi ke User (yang buat response/komentar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Aspirasi (response untuk aspirasi mana)
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class);
    }
}