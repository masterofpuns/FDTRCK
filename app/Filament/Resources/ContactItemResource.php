<?php

namespace App\Filament\Resources;

use App\Filament\Columns\IdColumn;
use App\Filament\Resources\ContactItemResource\Pages;
use App\Filament\Resources\ContactItemResource\RelationManagers;
use App\Models\ContactItem;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactItemResource extends Resource
{
    protected static ?string $model = ContactItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Contact';

    protected static ?string $pluralModelLabel = 'Contacten';

    protected static ?string $navigationGroup = 'Informatie';

    protected static ?int $navigationSort = 90;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('icon')
                        ->label(__('labels.icon'))
                        ->helperText(__('helper-text.icon'))
                        ->required()
                        ->length(4),

                    Forms\Components\TextInput::make('text')
                        ->label(__('labels.text'))
                        ->required()
                        ->maxLength(50),

                    Forms\Components\Textarea::make('url')
                        ->label(__('labels.url'))
                        ->required()
                        ->maxLength(1000),

                    Forms\Components\Toggle::make('is_button')
                        ->label(__('labels.is_button'))
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->label(__('labels.text')),

                Tables\Columns\IconColumn::make('is_button')
                    ->label(__('labels.is_button'))
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->reorderable('order');
    }

    /** @return array<int, class-string|\Filament\Resources\RelationManagers\RelationGroup> */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /** @return array<string, array<string, string>> */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactItems::route('/'),
            'create' => Pages\CreateContactItem::route('/create'),
            'edit' => Pages\EditContactItem::route('/{record}/edit'),
        ];
    }
}
