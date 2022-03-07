<?php

namespace Twill\Graphql\Tests;

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

// Twill
use A17\Twill\TwillServiceProvider;
use A17\Twill\Models\User;
use Faker\Factory as Faker;


class TestCase extends Orchestra
{
    use MakesGraphQLRequests;
    use UsesTestSchema;
    use MocksResolvers;


    /**
     * Twill consts for tests
     *
     * @var string
     */
    const DEFAULT_LOCALE = 'en';
    const DEFAULT_PASSWORD = 'secret';
    const DEFAULT_CONNECTION = 'sqlite';

    /**
     * Indicates if migrations ran.
     *
     * @var bool
     */
    protected static $migrated = false;

    protected function setUp(): void
    {
        parent::setUp();

        // Migrate 
        $this->artisan('migrate:fresh', [
            '--path' => __DIR__ . '/database/migrations',
            '--realpath' => true,
            '--database' => 'sqlite'
        ]);
    
        $this->faker = Faker::create(self::DEFAULT_LOCALE);

        // Create superadmin in Twill
        $this->superAdmin = $this->makeSuperAdmin();

        // Migrate Twill
        $this->setUpTwill();

        // Seed
        $this->artisan('db:seed', ['class' => \Twill\Graphql\Tests\Database\Seeders\DatabaseSeeder::class]);

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
            TwillServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
         /** @var \Illuminate\Contracts\Config\Repository $config */
        $config = $app->make(ConfigRepository::class);

        $config->set('database.default', self::DEFAULT_CONNECTION);
        $config->set('database.connections.' . self::DEFAULT_CONNECTION, $this->sqliteOptions());

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

    /**
     * Fake a super admin.
     */
    public function makeSuperAdmin()
    {
        $user = new User();

        $user->setAttribute('name', $this->faker->name);
        $user->setAttribute('email', $this->faker->email);
        $user->setAttribute('password', self::DEFAULT_PASSWORD);
        $user->setAttribute('unencrypted_password', self::DEFAULT_PASSWORD);

        return $this->superAdmin = $user;
    }

    protected function setUpTwill()
    {
        $this->artisan('twill:install')
            ->expectsQuestion('Enter an email', $this->superAdmin->email)
            ->expectsQuestion('Enter a password', $this->superAdmin->password)
            ->expectsQuestion(
                'Confirm the password',
                $this->superAdmin->password
            );
    }

    /**
     * @return array<string, mixed>
     */
    protected function sqliteOptions(): array
    {
        return [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ];
    }
}
