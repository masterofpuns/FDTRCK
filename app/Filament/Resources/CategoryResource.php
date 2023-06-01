<?php

namespace App\Filament\Resources;

use App\Filament\Columns\IdColumn;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Categorie';

    protected static ?string $pluralModelLabel = 'Categorieën';

    protected static ?string $navigationGroup = 'Bedrijf';

    protected static ?int $navigationSort = 10;

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

                    Forms\Components\SpatieMediaLibraryFileUpload::make('icon_svg')
                        ->label(__('labels.icon_svg'))
                        ->helperText(__('helper-text.icon_svg'))
                        ->required()
                        ->collection('icon'),

                    Forms\Components\TextInput::make('name')
                        ->label(__('labels.name'))
                        ->required()
                        ->maxLength(20),

                    Forms\Components\Textarea::make('description')
                        ->label(__('labels.description'))
                        ->nullable()
                        ->maxLength(1000),
                ]),
                Forms\Components\Card::make([
                    Forms\Components\SpatieMediaLibraryFileUpload::make('cta_gif')
                        ->label(__('labels.cta_gif'))
                        ->required()
                        ->collection('gif'),

                    Forms\Components\TextInput::make('cta_title')
                        ->label(__('labels.cta_title'))
                        ->required()
                        ->maxLength(200),
                    Forms\Components\Textarea::make('cta_subtitle')
                        ->label(__('labels.cta_subtitle'))
                        ->required()
                        ->maxLength(1000),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IdColumn::make(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('labels.name')),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('icon_svg')
                    ->label(__('labels.icon_svg'))
                    ->collection('icon'),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('cta_gif')
                    ->label(__('labels.cta_gif'))
                    ->collection('gif'),
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
            RelationManagers\FdtrcksRelationManager::class,
        ];
    }

    /** @return array<string, array<string, string>> */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
