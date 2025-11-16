<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tips Musik'],
            ['name' => 'Tutorial'],
            ['name' => 'Review'],
            ['name' => 'Event & Promo'],
            ['name' => 'Informasi Toko'],
        ];

        foreach ($categories as $category) {
            \App\Models\ArticleCategory::create($category);
        }
    }
}
