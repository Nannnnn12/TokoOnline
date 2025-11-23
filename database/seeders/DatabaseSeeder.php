<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'JOY KOWE',
        //     'email' => 'JOYKOWE@admin.com',
        //     'role' => 'admin',
        // ]);

        $this->call([
            // ReviewSeeder::class,
            CategorySeeder::class,
        ]);

    }
}
