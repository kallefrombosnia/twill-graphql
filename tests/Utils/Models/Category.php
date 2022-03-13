<?php

namespace Twill\Graphql\Tests\Utils\Models;

use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;

class Category extends Model 
{
    use HasFiles, HasMedias, HasBlocks, HasRevisions;

    protected $fillable = [
        'published',
        'title',
        'description',
    ];

    protected function getRevisionModel()
    {
        return 'Twill\\Graphql\\Tests\\Utils\\Models\\Revisions\\CategoryRevision';
    }

}
