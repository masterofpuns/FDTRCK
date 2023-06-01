<?php

namespace App\Filament\Resources\ContactItemResource\Pages;

use App\Filament\Resources\ContactItemResource;
use Closure;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListContactItems extends ListRecords
{
    protected static string $resource = ContactItemResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Model $record): ?string => null;
    }

    /** @return array<int, \Filament\Support\Actions\BaseAction> */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
