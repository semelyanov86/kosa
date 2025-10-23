<?php

namespace App\Http\Controllers\Api;

use App\Actions\GetContactList;
use App\Data\ContactData;
use App\Data\PaginationFilterData;
use App\Http\Controllers\Controller;
use Spatie\LaravelData\PaginatedDataCollection;

final class ContactsController extends Controller
{
    /**
     * @return PaginatedDataCollection<int, ContactData>
     */
    public function index(PaginationFilterData $request, GetContactList $action): PaginatedDataCollection
    {
        return $action->handle($request);
    }
}
