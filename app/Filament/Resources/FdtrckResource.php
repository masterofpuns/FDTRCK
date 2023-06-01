<?php

namespace App\Filament\Resources;

use App\Filament\Columns\IdColumn;
use App\Filament\Resources\FdtrckResource\Pages;
use App\Filament\Resources\FdtrckResource\RelationManagers;
use App\Models\Fdtrck;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FdtrckResource extends Resource
{
    protected static ?string $model = Fdtrck::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Truck';

    protected static ?string $pluralModelLabel = 'Trucks';

    protected static ?string $navigationGroup = 'Bedrijf';

    protected static ?int $navigationSort = 20;

    /** @return array<int, \Filament\Forms\Components\Component> */
    public static function attributeFields(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label(__('labels.name'))
                ->required()
                ->maxLength(50),

            Forms\Components\TextInput::make('slogan')
                ->label(__('labels.slogan'))
                ->required()
                ->maxLength(200),

            Forms\Components\Textarea::make('description')
                ->label(__('labels.description'))
                ->maxLength(1000),

            Forms\Components\TextInput::make('phone')
                ->label(__('labels.phone'))
                ->nullable()
                ->maxLength(15),

            Forms\Components\TextInput::make('lng')
                ->label(__('labels.lng'))
                ->helperText(__('helper-text.lng'))
                ->required()
                ->numeric()
                ->minValue(-180)
                ->maxValue(180)
                ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                    ->numeric()
                    ->decimalPlaces(7)
                    ->decimalSeparator('.')
                    ->mapToDecimalSeparator([',', '.'])
                    ->minValue(-180)
                    ->maxValue(180)
                    ->padFractionalZeros()
                ),

            Forms\Components\TextInput::make('lat')
                ->label(__('labels.lat'))
                ->helperText(__('helper-text.lat'))
                ->required()
                ->numeric()
                ->minValue(-90)
                ->maxValue(90)
                ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                    ->numeric()
                    ->decimalPlaces(7)
                    ->decimalSeparator('.')
                    ->mapToDecimalSeparator([',', '.'])
                    ->minValue(-90)
                    ->maxValue(90)
                    ->padFractionalZeros()
                ),

            Forms\Components\SpatieMediaLibraryFileUpload::make('main')
                ->label(__('labels.main'))
                ->required()
                ->collection('main'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\Select::make('category_id')
                        ->label(__('labels.category_id'))
                        ->relationship('category', 'name')
                        ->required(),

                    ...static::attributeFields(),
                ]),

                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('review_score')
                        ->label(__('labels.review_score'))
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->maxValue(5)
                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->numeric()
                            ->decimalPlaces(1)
                            ->decimalSeparator('.')
                            ->mapToDecimalSeparator([',', '.'])
                            ->minValue(0)
                            ->maxValue(5)
                            ->padFractionalZeros()
                        ),

                    Forms\Components\TextInput::make('review_count')
                        ->label(__('labels.review_count'))
                        ->numeric()
                        ->required()
                        ->minValue(0)
                        ->maxValue(1000000)
                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask
                            ->numeric()
                            ->integer()
                            ->minValue(0)
                            ->maxValue(1000000)
                        ),
                ]),
            ]);
    }

    /** @return array<int, \Filament\Tables\Columns\Column> */
    public static function attributeColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label(__('labels.name')),

            Tables\Columns\SpatieMediaLibraryImageColumn::make('main')
                ->label(__('labels.main'))
                ->collection('main'),

            Tables\Columns\TextColumn::make('review_score')
                ->label(__('labels.review_score'))
                ->formatStateUsing(fn ($state) => filled($state) ? number_format($state, 1, '.', '') : '-'),

            Tables\Columns\TextColumn::make('review_count')
                ->label(__('labels.review_count')),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('labels.category_id')),

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
            RelationManagers\MenuItemsRelationManager::class,
        ];
    }

    /** @return array<string, array<string, string>> */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFdtrcks::route('/'),
            'create' => Pages\CreateFdtrck::route('/create'),
            'edit' => Pages\EditFdtrck::route('/{record}/edit'),
        ];
    }
}
