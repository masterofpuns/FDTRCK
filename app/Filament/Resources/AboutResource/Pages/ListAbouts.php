<?php

namespace App\Filament\Resources\AboutResource\Pages;

use App\Filament\Resources\AboutResource;
use App\Models\About;
use Closure;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListAbouts extends ListRecords
{
    protected static string $resource = AboutResource::class;

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Model $record): ?string => null;
    }

    /** @return array<int, \Filament\Support\Actions\BaseAction> */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn () => About::count() < 1),
        ];
    }
}
