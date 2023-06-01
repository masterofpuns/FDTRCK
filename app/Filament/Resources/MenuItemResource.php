<?php

namespace App\Filament\Resources;

use App\Filament\Columns\IdColumn;
use App\Filament\Resources\MenuItemResource\Pages;
use App\Filament\Resources\MenuItemResource\RelationManagers;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Menu item';

    protected static ?string $pluralModelLabel = 'Menu items';

    protected static ?string $navigationGroup = 'Bedrijf';

    protected static ?int $navigationSort = 30;

    /** @return array<int, \Filament\Forms\Components\Component> */
    public static function attributeFields(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label(__('labels.name'))
                ->required()
                ->maxLength(50),

            Forms\Components\Textarea::make('description')
                ->label(__('labels.description'))
                ->maxLength(250),

            Forms\Components\TextInput::make('price')
                ->label(__('labels.price'))
                ->required()
                ->numeric()
                ->minValue(0)
                ->prefix('€')
                ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                    ->numeric()
                    ->decimalPlaces(2)
                    ->decimalSeparator('.')
                    ->mapToDecimalSeparator([',', '.'])
                    ->minValue(0)
                    ->padFractionalZeros()
                ),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Select::make('fdtrck_id')
                        ->label(__('labels.fdtrck_id'))
                        ->relationship('fdtrck', 'name')
                        ->required(),

                    ...static::attributeFields(),
                ]),
            ]);
    }

    /** @return array<int, \Filament\Tables\Columns\Column> */
    public static function attributeColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label(__('labels.name')),

            Tables\Columns\TextColumn::make('price')
                ->label(__('labels.price'))
                ->formatStateUsing(fn ($state) => Str::of('€ '.number_format($state, 2, ',', ''))->replace(',00', ',-')),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),

                ...static::attributeColumns(),
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}
