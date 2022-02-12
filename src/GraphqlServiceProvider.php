<?php

namespace Twill\Graphql;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Twill\Graphql\Commands\DeployCommand;

class GraphqlServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('twill-graphql')
            ->hasConfigFile()
            ->hasCommand(DeployCommand::class);
    }
}
