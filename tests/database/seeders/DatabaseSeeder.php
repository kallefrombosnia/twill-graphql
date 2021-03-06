<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            
            // Default model seeder
            CategorySeeder::class,

            // Files seeders
            FileSeeder::class,
            FileablesSeeder::class,

            // Media seeders
            MediaSeeder::class,
            MediablesSeeder::class,

            // Tag seeders
            TagSeeder::class,
            TaggableSeeder::class,

            // Block seeder
            BlockSeeder::class,

            // Revision seeder
            RevisionSeeder::class,
        ]);
    }
}
