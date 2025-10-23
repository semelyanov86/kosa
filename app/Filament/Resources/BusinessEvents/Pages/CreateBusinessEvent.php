<?php

namespace App\Filament\Resources\BusinessEvents\Pages;

use App\Filament\Resources\BusinessEvents\BusinessEventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinessEvent extends CreateRecord
{
    protected static string $resource = BusinessEventResource::class;
}
