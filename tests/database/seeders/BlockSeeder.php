<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use A17\Twill\Models\Block;

class BlockSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $block = new Block();

        $block->blockable_id = 2;
        $block->blockable_type = 'Twill\Graphql\Tests\Utils\Models\Category';
        $block->position = 1;
        $block->content = '{"quote":"TEST 2"}';
        $block->type = 'quote';
        $block->child_key = NULL;
        $block->parent_id = NULL;
        $block->editor_name = 'default';
        
        $block->save();
    }
}
