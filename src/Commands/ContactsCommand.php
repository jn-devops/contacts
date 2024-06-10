<?php

namespace Homeful\Contacts\Commands;

use Illuminate\Console\Command;

class ContactsCommand extends Command
{
    public $signature = 'contacts';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
