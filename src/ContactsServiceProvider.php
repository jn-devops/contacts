<?php

namespace Homeful\Contacts;

use Homeful\Contacts\Commands\ContactsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigration('update_fields_and_then_add_some_in_contacts_table')
            ->hasMigration('added_status_reason')
            ->hasCommand(ContactsCommand::class);
    }
}
