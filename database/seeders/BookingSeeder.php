<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bookings')->insert([
            'nama' => 'Andi Pratama',
            'tanggal' => '2025-11-10',
            'no_hp' => '081234567890',
            'paket_id' => '1',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
