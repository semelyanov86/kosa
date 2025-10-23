<?php

namespace App\Actions;

use App\Data\ContactData;
use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;

final readonly class UpdateContact
{
    use AsAction;

    public function handle(ContactData $contact): ContactData
    {
        $contactModel = Contact::findOrFail($contact->id);
        $contactModel->update($contact->toEntityArray());

        return $contact;
    }
}
