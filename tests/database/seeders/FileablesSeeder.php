<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileablesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Fileable 1
        DB::table('fileables')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'deleted_at' => null,
            'file_id' => 1,
            'fileable_id' => 1, 
            'fileable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'role' => 'single_file',
            'locale' => 'sl'
        ]);

        // Fileable 2
        DB::table('fileables')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'deleted_at' => null,
            'file_id' => 2,
            'fileable_id' => 2, 
            'fileable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'role' => 'single_file',
            'locale' => 'sl'
        ]);

        // Fileable 3
        DB::table('fileables')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'deleted_at' => null,
            'file_id' => 3,
            'fileable_id' => 2, 
            'fileable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'role' => 'single_file',
            'locale' => 'sl'
        ]);

        // Fileable 4
        DB::table('fileables')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'deleted_at' => null,
            'file_id' => 4,
            'fileable_id' => 2, 
            'fileable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'role' => 'single_file',
            'locale' => 'sl'
        ]);

        // Fileable 5
        DB::table('fileables')->insert([
            'created_at' => '2022-02-06 18:49:16',
            'updated_at' => '2022-02-16 00:28:38',
            'deleted_at' => null,
            'file_id' => 5,
            'fileable_id' => 2, 
            'fileable_type' => 'Twill\Graphql\Tests\Utils\Models\Category',
            'role' => 'single_file',
            'locale' => 'sl'
        ]);

    }
}
