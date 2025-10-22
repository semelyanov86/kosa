<?php

namespace App\Filament\Resources\BusinessEvents\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BusinessEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('place')->required(),
                Select::make('user_id')->relationship('user', 'name')->required(),
                DateTimePicker::make('started_at')->required(),
                DateTimePicker::make('ended_at')->required(),
            ]);
    }
}
