<?php

namespace App\Http\Controllers;

use App\Actions\GetBusinessEventsList;
use App\Data\PaginationFilterData;
use Inertia\Inertia;
use Inertia\Response;

final class BusinessEventController extends Controller
{
    public function index(PaginationFilterData $request, GetBusinessEventsList $action): Response
    {
        return Inertia::render('BusinessEvents', [
            'events' => $action->handle($request),
        ]);
    }
}
