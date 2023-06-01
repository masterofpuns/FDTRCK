<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use Closure;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListMenuItems extends ListRecords
{
    protected static string $resource = MenuItemResource::class;

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
