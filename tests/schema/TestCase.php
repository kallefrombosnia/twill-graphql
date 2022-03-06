<?php

namespace Twill\Graphql\Tests\Schema;

use Orchestra\Testbench\TestCase as Orchestra;
use Twill\Graphql\GraphqlServiceProvider;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Nuwave\Lighthouse\Testing\UsesTestSchema;
use Nuwave\Lighthouse\Testing\MocksResolvers;

// Lighthouse providers
use Nuwave\Lighthouse\Auth\AuthServiceProvider as LighthouseAuthServiceProvider;
use Nuwave\Lighthouse\GlobalId\GlobalIdServiceProvider;
use Nuwave\Lighthouse\LighthouseServiceProvider;
use Nuwave\Lighthouse\OrderBy\OrderByServiceProvider;
use Nuwave\Lighthouse\Pagination\PaginationServiceProvider;
use Nuwave\Lighthouse\Scout\ScoutServiceProvider as LighthouseScoutServiceProvider;
use Nuwave\Lighthouse\SoftDeletes\SoftDeletesServiceProvider;
use Nuwave\Lighthouse\Validation\ValidationServiceProvider;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use GraphQL\Error\DebugFlag;

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

            // Lighthouse
            GraphqlServiceProvider::class,
            LighthouseServiceProvider::class,
            LighthouseAuthServiceProvider::class,
            GlobalIdServiceProvider::class,
            LighthouseScoutServiceProvider::class,
            OrderByServiceProvider::class,
            PaginationServiceProvider::class,
            SoftDeletesServiceProvider::class,
            ValidationServiceProvider::class,

            // Twill
            \A17\Twill\TwillServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
         /** @var \Illuminate\Contracts\Config\Repository $config */
        $config = $app->make(ConfigRepository::class);

        $config->set('lighthouse.namespaces', [
            'models' => [
                'A17\\Twill\\Models',
                'Twill\\Graphql\\Tests\\Utils\\Models'
            ]  
        ]);
 
         $config->set('app.debug', true);
         $config->set(
            'lighthouse.debug',
            DebugFlag::INCLUDE_DEBUG_MESSAGE
            | DebugFlag::INCLUDE_TRACE
            // | Debug::RETHROW_INTERNAL_EXCEPTIONS
            | DebugFlag::RETHROW_UNSAFE_EXCEPTIONS
         );
    }
}
