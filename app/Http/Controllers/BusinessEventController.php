<?php

namespace App\Http\Controllers;

use App\Actions\CreateEvent;
use App\Actions\GetBusinessEventsList;
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

    public function edit(int $id, GetEventById $action): Response
    {
        return Inertia::render('CreateEvent', [
            'id' => $id,
            'event' => $action->handle($id),
        ]);
    }

    public function create(Request $request): Response
    {
        return Inertia::render('CreateEvent', [
            'id' => 0,
            'event' => BusinessEventData::generateNullable(),
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
}
