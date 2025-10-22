<?php

namespace App\Actions;

use App\Data\BusinessEventData;
use App\Data\PaginationFilterData;
use App\Models\BusinessEvent;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;

final readonly class GetBusinessEventsList
{
    use AsAction;

    /**
     * @return PaginatedDataCollection<int, BusinessEventData>
     */
    public function handle(PaginationFilterData $filter): PaginatedDataCollection
    {
        return BusinessEventData::collect(BusinessEvent::paginate(perPage: $filter->perPage, page: $filter->page), PaginatedDataCollection::class);
    }
}
