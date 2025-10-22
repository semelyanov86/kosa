<?php

namespace App\Filament\Resources\BusinessEvents\Pages;

use App\Filament\Resources\BusinessEvents\BusinessEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBusinessEvents extends ListRecords
{
    protected static string $resource = BusinessEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
