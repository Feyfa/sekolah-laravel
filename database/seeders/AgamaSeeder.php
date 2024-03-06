<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agama::insert([
            [
                'name' => env('AGAMA_SEEDER_1'),
            ],
            [
                'name' => env('AGAMA_SEEDER_2'),
            ],
            [
                'name' => env('AGAMA_SEEDER_3'),
            ],
            [
                'name' => env('AGAMA_SEEDER_4'),
            ],
            [
                'name' => env('AGAMA_SEEDER_5'),
            ],
        ]);
    }
}
