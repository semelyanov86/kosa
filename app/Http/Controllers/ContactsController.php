<?php

namespace App\Http\Controllers;

use App\Actions\GetContactList;
use App\Data\PaginationFilterData;
use Inertia\Inertia;
use Inertia\Response;

final class ContactsController extends Controller
{
    public function index(PaginationFilterData $request, GetContactList $contactAction): Response
    {
        return Inertia::render('Dashboard', [
            'contacts' => $contactAction->handle($request),
        ]);
    }
}
