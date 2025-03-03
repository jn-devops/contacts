<?php

namespace Homeful\Contacts\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $table = 'media';

    public function getConnectionName()
    {
        $connection = config('contacts.models.media.connection');

        return !empty($connection)
            ? $connection
            : parent::getConnectionName();
    }
}
