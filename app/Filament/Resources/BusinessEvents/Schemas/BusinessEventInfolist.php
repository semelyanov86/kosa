<?php

namespace App\Filament\Resources\BusinessEvents\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BusinessEventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('place'),
                TextEntry::make('user.name'),
                TextEntry::make('started_at'),
                TextEntry::make('ended_at'),
                TextEntry::make('created_at'),
            ]);
    }
}
