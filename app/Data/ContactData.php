<?php

namespace App\Data;

use Spatie\LaravelData\Data;

final class ContactData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $phone,
        public string $position,
        public ?string $company,
        public ?string $address,
        public ?string $city,
        public ?string $zip,
    ) {}
}
