<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('pakets')->insert([
            'nama_paket' => 'Family',
            'harga_paket' => '15000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
