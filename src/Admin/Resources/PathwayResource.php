<?php

namespace Admin\Resources;

use Admin\Resources\PathwayResource\Pages\CreatePathway;
use Admin\Resources\PathwayResource\Pages\EditPathway;
use Admin\Resources\PathwayResource\Pages\ListPathways;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Shared\Infrastructure\Laravel\Eloquent\Models\Pathway;

class PathwayResource extends Resource
{
    protected static ?string $model = Pathway::class;

    protected static ?string $slug = 'pathways';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('description')
                    ->required(),

                TextInput::make('post_bac_level')
                    ->required()
                    ->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description'),

                TextColumn::make('post_bac_level'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPathways::route('/'),
            'create' => CreatePathway::route('/create'),
            'edit' => EditPathway::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
