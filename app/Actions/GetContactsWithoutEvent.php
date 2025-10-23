<?php

namespace App\Actions;

use App\Data\ContactData;
use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;

final readonly class GetContactsWithoutEvent
{
    use AsAction;

    /**
     * @return ContactData[]
     */
    public function handle(int $eventId): array
    {
        $contacts = Contact::whereDoesntHave('businessEvents', fn ($query) => $query->where('business_event_id', $eventId)
        )->get();

        return ContactData::collect($contacts, 'array');
    }
}
