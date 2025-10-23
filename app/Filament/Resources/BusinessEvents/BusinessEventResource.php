<?php

namespace App\Filament\Resources\BusinessEvents;

use App\Filament\Resources\BusinessEvents\Pages\CreateBusinessEvent;
use App\Filament\Resources\BusinessEvents\Pages\EditBusinessEvent;
use App\Filament\Resources\BusinessEvents\Pages\ListBusinessEvents;
use App\Filament\Resources\BusinessEvents\Pages\ViewBusinessEvent;
use App\Filament\Resources\BusinessEvents\RelationManagers\ContactsRelationManager;
use App\Filament\Resources\BusinessEvents\Schemas\BusinessEventForm;
use App\Filament\Resources\BusinessEvents\Schemas\BusinessEventInfolist;
use App\Filament\Resources\BusinessEvents\Tables\BusinessEventsTable;
use App\Models\BusinessEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class BusinessEventResource extends Resource
{
    protected static ?string $model = BusinessEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Eye;

    protected static ?string $recordTitleAttribute = 'name';

    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return BusinessEventForm::configure($schema);
    }

    #[\Override]
    public static function infolist(Schema $schema): Schema
    {
        return BusinessEventInfolist::configure($schema);
    }

    #[\Override]
    public static function table(Table $table): Table
    {
        return BusinessEventsTable::configure($table);
    }

    #[\Override]
    public static function getRelations(): array
    {
        return [
            ContactsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBusinessEvents::route('/'),
            'create' => CreateBusinessEvent::route('/create'),
            'view' => ViewBusinessEvent::route('/{record}'),
            'edit' => EditBusinessEvent::route('/{record}/edit'),
        ];
    }
}
