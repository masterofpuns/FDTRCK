<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Closure;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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
