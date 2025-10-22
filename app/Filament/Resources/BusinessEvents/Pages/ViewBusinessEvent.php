<?php

namespace App\Filament\Resources\BusinessEvents\Pages;

use App\Filament\Resources\BusinessEvents\BusinessEventResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessEvent extends ViewRecord
{
    protected static string $resource = BusinessEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
