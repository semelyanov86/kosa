<?php

namespace App\Filament\Resources\BusinessEvents\Pages;

use App\Filament\Resources\BusinessEvents\BusinessEventResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBusinessEvent extends EditRecord
{
    protected static string $resource = BusinessEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
