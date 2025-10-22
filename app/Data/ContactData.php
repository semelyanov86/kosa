<?php

namespace App\Data;

use Spatie\LaravelData\Data;

final class ContactData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $email,
        public string $phone,
        public string $position,
        public ?string $company,
        public ?string $address,
        public ?string $city,
        public ?string $zip,
    ) {}

    /**
     * @return array<string, scalar>
     */
    public function toEntityArray(): array
    {
        /** @var array<string, scalar> $data */
        $data = $this->toArray();
        unset($data['id']);

        return $data;
    }

    public static function generateNullable(): ContactData
    {
        return new self(
            id: 0,
            name: '',
            email: '',
            phone: '',
            position: '',
            company: '',
            address: '',
            city: '',
            zip: '',
        );
    }
}
