<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaggableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Taggable 1
        DB::table('tagged')->insert([
            'taggable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'taggable_id' => 2,
            'tag_id' => 1
        ]);

        // Taggable 2
        DB::table('tagged')->insert([
            'taggable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'taggable_id' => 2,
            'tag_id' => 2
        ]);

        // Taggable 3
        DB::table('tagged')->insert([
            'taggable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'taggable_id' => 2,
            'tag_id' => 3
        ]);
    }
}