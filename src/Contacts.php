<?php

namespace Homeful\Contacts;

use Homeful\Contacts\Actions\GetContactMetadataFromContactModel;
use Homeful\Contacts\Classes\ContactMetaData;
use Homeful\Contacts\Models\Contact;
class Contacts {
    public function fromContactModelToContactMetadata(Contact $contact): ContactMetaData
    {
        return app(GetContactMetadataFromContactModel::class)->run($contact);
    }
}
