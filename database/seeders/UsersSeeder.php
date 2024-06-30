<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'demo@demo.com'
        ], [
            'name' => 'Dev',
            'password' => Hash::make('demo'),
            'role_id' => 1,
            'image_name' => '3x.webp',
            'image_path' => 'images/3x.webp',
        ]);
    }
}
