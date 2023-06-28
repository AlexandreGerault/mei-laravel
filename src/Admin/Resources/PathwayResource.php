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
use Webmozart\Assert\Assert;

class PathwayResource extends Resource
{
    protected static ?string $model = Pathway::class;

    protected static ?string $slug = 'pathways';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-chalkboard-user';

    public static function getModelLabel(): string
    {
        $label = __('pathway');

        Assert::string($label);

        return $label;
    }

    public static function getPluralModelLabel(): string
    {
        $label = __('pathways');

        Assert::string($label);

        return $label;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('name'))
                    ->required(),

                TextInput::make('description')
                    ->label(__('description'))
                    ->required(),

                TextInput::make('post_bac_level')
                    ->label(__('post_bac_level'))
                    ->required()
                    ->integer(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label(__('description')),

                TextColumn::make('post_bac_level')
                    ->label(__('post_bac_level')),
            ]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListPathways::route('/'),
            'create' => CreatePathway::route('/create'),
            'edit' => EditPathway::route('/{record}/edit'),
        ];
    }

    /**
     * @return string[]
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('data');
    }
}
