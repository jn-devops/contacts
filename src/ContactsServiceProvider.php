<?php

namespace Homeful\Contacts;

use Spatie\LaravelPackageTools\PackageServiceProvider;
use Homeful\Contacts\Commands\ContactsCommand;
use Spatie\LaravelPackageTools\Package;

class ContactsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('contacts')
            ->hasConfigFile(['contacts', 'data', 'media-library'])
            ->hasViews()
            ->hasRoute('api')
            ->hasMigration('create_contacts_table')
            ->hasCommand(ContactsCommand::class);
    }
}
