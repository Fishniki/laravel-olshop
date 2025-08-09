<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pakaian extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pakaians')->insert([
            [
                'nama'       => 'Sepatu Addidas Samba',
                'harga'      => 50000,
                'stok'       => 50,
                'kategori'   => 'Kaos',
                'author'     => 'Admin User',
                'bobot'      => 250, // gram
                'sent_from'  => 'Jakarta',
                'image'      => 'items-image/RZF3ZUVpdlqXKY9mMytCzqKxCFDNUUTDqNQmlvJw.jpg',
                'deskripsi'  => 'Kaos polos warna putih, nyaman dipakai untuk sehari-hari.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama'       => 'Jaket Hoodie Hitam',
                'harga'      => 150000,
                'stok'       => 20,
                'kategori'   => 'Jaket',
                'author'     => 'Admin User',
                'bobot'      => 800, // gram
                'sent_from'  => 'Bandung',
                'image'      => 'items-image/sf8TwX8Ml7ey6yLlGiWbvFnocx2b82h6i8A7yhgJ.jpg',
                'deskripsi'  => 'Jaket hoodie hitam bahan fleece, cocok untuk cuaca dingin.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
