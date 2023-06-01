<?php

namespace App\Filament\Resources;

use App\Filament\Columns\IdColumn;
use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = 'Over';

    protected static ?string $pluralModelLabel = 'Over';

    protected static ?string $navigationGroup = 'Informatie';

    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('title')
                        ->label(__('labels.title'))
                        ->required()
                        ->maxLength(200),

                    Forms\Components\RichEditor::make('text')
                        ->label(__('labels.text'))
                        ->required()
                        ->maxLength(65535),
                ]),
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('button_text')
                        ->label(__('labels.button_text'))
                        ->required()
                        ->maxLength(50),

                    Forms\Components\TextInput::make('button_url')
                        ->label(__('labels.button_url'))
                        ->required()
                        ->maxLength(1000),
                ]),
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('copyright_title')
                        ->label(__('labels.copyright_title'))
                        ->required()
                        ->maxLength(200),

                    Forms\Components\RichEditor::make('copyright_text')
                        ->label(__('labels.copyright_text'))
                        ->required()
                        ->maxLength(65535),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('labels.title'))
                    ->wrap(),

                Tables\Columns\TextColumn::make('copyright_title')
                    ->label(__('labels.copyright_title'))
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
