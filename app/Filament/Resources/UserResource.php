<?php

namespace App\Filament\Resources;

use App\Filament\Columns\IdColumn;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Gebruiker';

    protected static ?string $pluralModelLabel = 'Gebruikers';

    protected static ?string $navigationGroup = 'Systeem';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')
                        ->label(__('labels.name'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('email')
                        ->label(__('labels.email'))
                        ->email()
                        ->required()
                        ->maxLength(254)
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('password')
                        ->label(__('labels.password'))
                        ->password()
                        ->required(fn (?User $record) => is_null($record) || ! $record->exists())
                        ->nullable(fn (?User $record) => ! is_null($record) && $record->exists())
                        ->confirmed()
                        ->dehydrated(fn ($state) => filled($state))
                        ->helperText(fn (?User $record) => ! is_null($record) && $record->exists() ? __('helper-text.password') : null),

                    Forms\Components\TextInput::make('passwordConfirmation')
                        ->label(__('labels.passwordConfirmation'))
                        ->password()
                        ->required(fn (?User $record) => is_null($record) || ! $record->exists())
                        ->dehydrated(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('labels.name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('labels.email'))
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
