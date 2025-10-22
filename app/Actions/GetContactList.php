<?php

namespace App\Actions;

use App\Data\ContactData;
use App\Data\PaginationFilterData;
use App\Models\Contact;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;

final readonly class GetContactList
{
    use AsAction;

    /**
     * @return PaginatedDataCollection<int, ContactData>
     */
    public function handle(PaginationFilterData $filter): PaginatedDataCollection
    {
        return ContactData::collect(Contact::paginate(page: $filter->page, perPage: $filter->perPage), PaginatedDataCollection::class);
    }
}
