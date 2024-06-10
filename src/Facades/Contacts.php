<?php

namespace Homeful\Contacts\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Homeful\Contacts\Contacts
 */
class Contacts extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Homeful\Contacts\Contacts::class;
    }
}
