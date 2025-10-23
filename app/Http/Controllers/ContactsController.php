<?php

namespace App\Http\Controllers;

use App\Actions\CreateContact;
use App\Actions\GetContactById;
use App\Actions\GetContactList;
use App\Actions\UpdateContact;
use App\Data\ContactData;
use App\Data\PaginationFilterData;
use App\Http\Requests\BusinessCardRequest;
use App\Http\Requests\ContactEditRequest;
use App\Models\Contact;
use App\Services\MindeeBusinessCardService;
use Illuminate\Http\RedirectResponse;
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

    public function delete(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return to_route('dashboard')->with('message', 'Contact deleted and can not be restored');
    }

    public function parseBusinessCard(
        BusinessCardRequest $request,
        MindeeBusinessCardService $mindeeService,
        CreateContact $createAction
    ): RedirectResponse {
        $tempFilePath = null;

        try {
            /** @var \Illuminate\Http\UploadedFile|null $file */
            $file = $request->file('business_card');

            if (! $file) {
                throw new \Exception('No file uploaded');
            }

            if (! $file->isValid()) {
                throw new \Exception('Uploaded file is not valid: '.$file->getErrorMessage());
            }

            $tempDir = storage_path('app/temp');
            if (! is_dir($tempDir) && ! mkdir($tempDir, 0755, true) && ! is_dir($tempDir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $tempDir));
            }

            $fileName = uniqid('', true).'_'.time().'.'.$file->getClientOriginalExtension();

            $tempFilePath = $tempDir.'/'.$fileName;
            $file->move($tempDir, $fileName);

            if (! file_exists($tempFilePath)) {
                throw new \Exception("Failed to save file to: {$tempFilePath}");
            }

            \Log::info('Business card file saved', [
                'path' => $tempFilePath,
                'size' => filesize($tempFilePath),
            ]);

            $contactData = $mindeeService->parseBusinessCard($tempFilePath);

            $createdContact = $createAction->handle($contactData);

            return to_route('contacts.edit', ['id' => $createdContact->id])->with('message', 'Contact successfully updated with id '.$createdContact->id);

        } catch (\Exception $e) {
            \Log::error('Business card parsing failed', [
                'message' => $e->getMessage(),
                'file' => $request->file('business_card')?->getClientOriginalName(),
                'temp_path' => $tempFilePath,
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withErrors($e->getMessage())->with('message', $e->getMessage());

        }
    }
}
