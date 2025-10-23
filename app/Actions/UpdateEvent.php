<?php

namespace App\Actions;

use App\Data\BusinessEventData;
use App\Models\BusinessEvent;
use Lorisleiva\Actions\Concerns\AsAction;

final readonly class UpdateEvent
{
    use AsAction;

    public function handle(BusinessEventData $data): void
    {
        $eventModel = BusinessEvent::findOrFail($data->id);
        $eventModel->update($data->toEntityArray());
    }
}
