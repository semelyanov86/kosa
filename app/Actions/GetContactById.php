<?php

namespace App\Actions;

use App\Data\ContactData;
use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;

final readonly class GetContactById
{
    use AsAction;

    public function handle(int $id): ContactData
    {
        return ContactData::from(Contact::findOrFail($id));
    }
}
