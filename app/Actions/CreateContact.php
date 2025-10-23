<?php

namespace App\Actions;

use App\Data\ContactData;
use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;

final readonly class CreateContact
{
    use AsAction;

    public function handle(ContactData $contact): ContactData
    {
        $contactModel = Contact::create($contact->toEntityArray());
        $contact->id = $contactModel->id;

        return $contact;
    }
}
