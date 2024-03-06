<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::insert([
            [
                'name' => env('KELAS_SEEDER_1')
            ],
            [
                'name' => env('KELAS_SEEDER_2')
            ],
            [
                'name' => env('KELAS_SEEDER_3')
            ],
            [
                'name' => env('KELAS_SEEDER_4')
            ],
            [
                'name' => env('KELAS_SEEDER_5')
            ],
            [
                'name' => env('KELAS_SEEDER_6')
            ],
        ]);
    }
}
