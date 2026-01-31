<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['sarana', 'prasarana', 'lainnya'];

        foreach ($kategori as $nama_kategori) {
            Kategori::create(['nama_kategori' => $nama_kategori]);
        }
    }
}
