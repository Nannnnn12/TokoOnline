<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                // Assuming you have these icons uploaded in storage/app/public/category-icons/
                'icon' => 'category-icons/electronics.png',
            ],
            [
                'category_name' => 'Fashion',
                'slug' => Str::slug('Fashion'),
                'icon' => 'category-icons/fashion.png',
            ],
            [
                'category_name' => 'Home & Living',
                'slug' => Str::slug('Home & Living'),
                'icon' => 'category-icons/home-living.png',
            ],
            [
                'category_name' => 'Books',
                'slug' => Str::slug('Books'),
                'icon' => 'category-icons/books.png',
            ],
            [
                'category_name' => 'Sports',
                'slug' => Str::slug('Sports'),
                'icon' => 'category-icons/sports.png',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
