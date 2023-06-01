<?php

namespace App\Filament\Resources\ContactItemResource\Pages;

use App\Filament\Resources\ContactItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactItem extends EditRecord
{
    protected static string $resource = ContactItemResource::class;

    /** @return array<int, \Filament\Support\Actions\BaseAction> */
    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
