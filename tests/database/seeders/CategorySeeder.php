<?php

namespace Twill\Graphql\Tests\Database\Seeders;

use Illuminate\Database\Seeder;
use Twill\Graphql\Tests\Utils\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->deleted_at = null;
        $category->created_at = '2022-02-06 18:49:16';
        $category->updated_at = '2022-02-16 00:28:38';
        $category->published = 1;
        $category->title = 'Books';
        $category->description = 'Just a plain description of the books category';

        $category->save();

        $category = new Category();
        $category->deleted_at = null;
        $category->created_at = '2022-02-08 01:54:21';
        $category->updated_at = '2022-03-01 19:39:33';
        $category->published = 1;
        $category->title = 'Cars';
        $category->description = 'Cars are awesome.';

        $category->save();
    }
}
