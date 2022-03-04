<?php

namespace Twill\Graphql\Tests\Schema;

use Orchestra\Testbench\TestCase as Orchestra;
use Twill\Graphql\GraphqlServiceProvider;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Nuwave\Lighthouse\Testing\UsesTestSchema;
use Nuwave\Lighthouse\Testing\MocksResolvers;

class TestCase extends Orchestra
{
    use MakesGraphQLRequests;
    use UsesTestSchema;
    use MocksResolvers;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            GraphqlServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        
        // Set lighthouse route name
        config()->set('lighthouse.route.name', 'graphql');


        /*
        $migration = include __DIR__.'/../database/migrations/create_twill-graphql_table.php.stub';
        $migration->up();
        */
    }
}
