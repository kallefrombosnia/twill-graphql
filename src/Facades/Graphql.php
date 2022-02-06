<?php

namespace Twill\Graphql\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Twill\Graphql\Graphql
 */
class Graphql extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'twill-graphql';
    }
}
