<?php

namespace Homeful\Contacts\Tests;

use Homeful\Contacts\ContactsServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Homeful\\Contacts\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ContactsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        //        config()->set('app.url', '');
        config()->set('data.validation_strategy', 'always');
        config()->set('data.max_transformation_depth', 5);
        config()->set('data.throw_when_max_transformation_depth_reached', 5);

        $migration = include __DIR__.'/../database/migrations/create_contacts_table.php.stub';
        $migration->up();
        $migration = include __DIR__.'/../database/migrations/update_fields_and_then_add_some_in_contacts_table.php.stub';
        $migration->up();
        $migration = include __DIR__.'/../database/migrations/added_status_reason.php.stub';
        $migration->up();
    }
}
