<?php

namespace App\Actions;

use App\Data\BusinessEventData;
use App\Models\BusinessEvent;
use Lorisleiva\Actions\Concerns\AsAction;

final readonly class CreateEvent
{
    use AsAction;

    public function handle(BusinessEventData $data): BusinessEventData
    {
        $model = BusinessEvent::create($data->toEntityArray());
        $data->id = $model->id;

        return $data;
    }
}
