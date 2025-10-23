<?php

namespace App\Filament\Resources\BusinessEvents\RelationManagers;

use App\Filament\Resources\Contacts\ContactResource;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class ContactsRelationManager extends RelationManager
{
    protected static string $relationship = 'contacts';

    protected static ?string $relatedResource = ContactResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
                AttachAction::make()->preloadRecordSelect()->recordSelectSearchColumns(['name', 'email'])->recordTitleAttribute('name'),
            ])->recordActions([
                DetachAction::make(),
            ]);
    }
}
