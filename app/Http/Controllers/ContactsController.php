<?php

namespace App\Http\Controllers;

use App\Actions\CreateContact;
use App\Actions\GetContactById;
use App\Actions\GetContactList;
use App\Actions\UpdateContact;
use App\Data\ContactData;
use App\Data\PaginationFilterData;
use App\Http\Requests\ContactEditRequest;
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

    public function store(ContactEditRequest $request, CreateContact $action): \Illuminate\Http\RedirectResponse
    {
        $result = $action->handle($request->toDto());

        return to_route('contacts.edit', ['id' => $result->id])->with('message', 'Contact successfully created with id '.$result->id);
    }

    public function update(int $id, ContactEditRequest $request, UpdateContact $action): \Illuminate\Http\RedirectResponse
    {
        $dto = $request->toDto();
        $dto->id = $id;
        $action->handle($dto);

        return to_route('dashboard')->with('message', 'Contact successfully updated with id '.$id);
    }
}
