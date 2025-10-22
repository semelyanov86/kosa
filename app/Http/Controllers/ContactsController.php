<?php

namespace App\Http\Controllers;

use App\Actions\GetContactById;
use App\Actions\GetContactList;
use App\Data\ContactData;
use App\Data\PaginationFilterData;
use Illuminate\Http\Request;
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

    public function create(Request $request): Response
    {
        return Inertia::render('ContactCreate', [
            'id' => null,
            'contact' => ContactData::generateNullable(),
        ]);
    }

    public function edit(int $id, GetContactById $action): Response
    {
        return Inertia::render('ContactCreate', [
            'id' => $id,
            'contact' => $action->handle($id),
        ]);
    }

    public function store(ContactData $contactData): \Illuminate\Http\RedirectResponse
    {
        return to_route('dashboard');
    }

    public function update(int $id, ContactData $contactData, Request $request): \Illuminate\Http\RedirectResponse
    {
        return to_route('dashboard');
    }
}
