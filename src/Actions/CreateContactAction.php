<?php

namespace Homeful\Contacts\Actions;

use Homeful\Contacts\Events\ContactPersisted;
use Homeful\Contacts\Models\Contact;

class CreateContactAction extends PersistContactAction
{
    protected function persist(array $validated): Contact
    {
        $contact = Contact::create($validated);
        ContactPersisted::dispatch($contact);

        return $contact;
    }
}
