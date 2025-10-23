<?php

namespace App\Actions;

use App\Data\BusinessEventData;
use App\Models\BusinessEvent;
use Lorisleiva\Actions\Concerns\AsAction;

final readonly class GetEventById
{
    use AsAction;

    public function handle(int $id): BusinessEventData
    {
        $model = BusinessEvent::with(['contacts'])->findOrFail($id);

        return BusinessEventData::fromModel($model);
    }
}
