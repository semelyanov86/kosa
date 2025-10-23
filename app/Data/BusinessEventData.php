<?php

namespace App\Data;

use App\Models\BusinessEvent;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;

final class BusinessEventData extends Data
{
    /**
     * @param  ContactData[]  $contacts
     */
    public function __construct(
        public ?int $id,
        public string $name,
        public string $place,
        #[Date]
        #[WithCast(DateTimeInterfaceCast::class, 'Y-m-d H:i')]
        public CarbonImmutable $started_at,
        #[Date]
        #[WithCast(DateTimeInterfaceCast::class, 'Y-m-d H:i')]
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

    /**
     * @return array<string, mixed>
     */
    public function toEntityArray(): array
    {
        /** @var array<string, mixed> $data */
        $data = $this->toArray();
        unset($data['id'], $data['created_at'], $data['updated_at'], $data['contacts']);
        $data['user_id'] = Auth::id();

        return $data;
    }

    public static function generateNullable(): self
    {
        return new self(
            id: null,
            name: '',
            place: '',
            started_at: now(),
            ended_at: now()->addDay(),
            contacts: [],
        );
    }
}
