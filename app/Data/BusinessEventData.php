<?php

namespace App\Data;

use App\Models\BusinessEvent;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

final class BusinessEventData extends Data
{
    /**
     * @param  ContactData[]  $contacts
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $place,
        public CarbonImmutable $started_at,
        public CarbonImmutable $ended_at,
        public array $contacts = [],
    ) {}

    public static function fromModel(BusinessEvent $event): self
    {
        return new self(
            id: $event->id,
            name: $event->name,
            place: $event->place,
            started_at: $event->started_at,
            ended_at: $event->ended_at,
            contacts: $event->relationLoaded('contacts') ? ContactData::collect($event->contacts, 'array') : [],
        );
    }
}
