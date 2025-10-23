<?php

namespace App\Http\Controllers;

use App\Actions\CreateEvent;
use App\Actions\GetBusinessEventsList;
use App\Actions\GetContactsWithoutEvent;
use App\Actions\GetEventById;
use App\Actions\UpdateEvent;
use App\Data\BusinessEventData;
use App\Data\PaginationFilterData;
use App\Models\BusinessEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function edit(int $id, GetEventById $action, GetContactsWithoutEvent $contactsAction): Response
    {
        return Inertia::render('CreateEvent', [
            'id' => $id,
            'event' => $action->handle($id),
            'otherContacts' => $contactsAction->handle($id),
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('CreateEvent', [
            'id' => 0,
            'event' => BusinessEventData::generateNullable(),
            'otherContacts' => [],
        ]);
    }

    public function store(BusinessEventData $request, CreateEvent $action): RedirectResponse
    {
        $request = $action->handle($request);

        return to_route('events.edit', ['id' => $request->id])->with('message', 'Business Event created successfully with ID '.$request->id);
    }

    public function update(int $id, BusinessEventData $request, UpdateEvent $action): RedirectResponse
    {
        $request->id = $id;
        $action->handle($request);

        return to_route('events.index')->with('message', 'Business Event updated successfully with ID '.$request->id);
    }

    public function delete(BusinessEvent $event): RedirectResponse
    {
        $event->delete();

        return to_route('events.index')->with('message', 'Business Event deleted successfully. You can not restore it.');
    }

    public function attach(BusinessEvent $event, int $contactId): RedirectResponse
    {
        $event->contacts()->attach($contactId);

        return back()->with('message', 'Contact attached to Business Event successfully');
    }

    public function detach(BusinessEvent $event, int $contactId): RedirectResponse
    {
        $event->contacts()->detach($contactId);

        return back()->with('message', 'Contact detached from Business Event successfully');
    }
}
