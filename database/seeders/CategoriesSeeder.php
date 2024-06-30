<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummy = [
            'News',
            'Events',
            'Jobs',
            'Announcements',
            'Publications',
            'Others',
        ];

        foreach ($dummy as $category) {
            Category::firstOrCreate([
                'name' => $category,
            ], [
                'slug' => strtolower($category),
            ]);
        }
    }
}
