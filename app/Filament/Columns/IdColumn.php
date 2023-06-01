<?php

namespace App\Filament\Columns;

use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class IdColumn extends TextColumn
{
    public static function make(string $name = 'id'): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->getName() == 'id') {
            $this->label('ID');
        }

        $this->sortable();

        $this->url(function (?Model $record): ?string {
            if (is_null($record)) {
                return null;
            }

            /** @var class-string|null */
            $resource = Filament::getModelResource($record);
            if (is_null($resource) || ! is_a($resource, \Filament\Resources\Resource::class, true)) {
                return null;
            }

            if ($resource::hasPage('view') && $resource::canView($record)) {
                return $resource::getUrl('view', ['record' => $record]);
            }

            if ($resource::hasPage('edit') && $resource::canEdit($record)) {
                return $resource::getUrl('edit', ['record' => $record]);
            }

            return null;
        });
    }
}
