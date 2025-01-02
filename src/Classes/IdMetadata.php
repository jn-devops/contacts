<?php

namespace Homeful\Contacts\Classes;

use Homeful\Common\Traits\WithAck;
use Spatie\LaravelData\Data;

class IdMetadata extends Data
{
    use WithAck;

    public function __construct(
        public string $tin, //better if BIR?
        public ?string $pagibig,
        public ?string $sss,
        public ?string $gsis,
    ) {}
}
