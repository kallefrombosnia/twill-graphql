<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Tag 1
        DB::table('tags')->insert([
            'namespace' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'slug' => 'first',
            'name' => 'first',
            'count' => 1
        ]);

        // Tag 2
        DB::table('tags')->insert([
            'namespace' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'slug' => 'second',
            'name' => 'second',
            'count' => 1
        ]);

        // Tag 3
        DB::table('tags')->insert([
            'namespace' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'slug' => 'third',
            'name' => 'third',
            'count' => 1
        ]);
    }
}