<?php

namespace App\Filament\Resources\FdtrckResource\Pages;

use App\Filament\Resources\FdtrckResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFdtrck extends EditRecord
{
    protected static string $resource = FdtrckResource::class;

    /** @return array<int, \Filament\Support\Actions\BaseAction> */
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
