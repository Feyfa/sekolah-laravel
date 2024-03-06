<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => env('ADMIN_SEEDER_NAME'),
            'jabatan' => env('ADMIN_SEEDER_JABATAN'),
            'username' => env('ADMIN_SEEDER_USERNAME'),
            'password' => Hash::make(env('ADMIN_SEEDER_PASSWORD')),
        ]);
    }
}
