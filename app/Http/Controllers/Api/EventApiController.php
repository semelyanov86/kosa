<?php

namespace App\Http\Controllers\Api;

use App\Actions\GetBusinessEventsList;
use App\Data\BusinessEventData;
use App\Data\PaginationFilterData;
use App\Http\Controllers\Controller;
use Spatie\LaravelData\PaginatedDataCollection;

class EventApiController extends Controller
{
    /**
     * @return PaginatedDataCollection<int, BusinessEventData>
     */
    public function index(PaginationFilterData $request, GetBusinessEventsList $action): PaginatedDataCollection
    {
        return $action->handle($request);
    }
}
