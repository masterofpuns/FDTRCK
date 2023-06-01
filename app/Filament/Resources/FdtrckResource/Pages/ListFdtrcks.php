<?php

namespace App\Filament\Resources\FdtrckResource\Pages;

use App\Filament\Resources\FdtrckResource;
use Closure;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListFdtrcks extends ListRecords
{
    protected static string $resource = FdtrckResource::class;

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
