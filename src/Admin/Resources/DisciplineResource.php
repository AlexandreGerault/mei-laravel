<?php

namespace Admin\Resources;

use Admin\Resources\DisciplineResource\Pages\CreateDiscipline;
use Admin\Resources\DisciplineResource\Pages\EditDiscipline;
use Admin\Resources\DisciplineResource\Pages\ListDisciplines;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Shared\Infrastructure\Laravel\Eloquent\Models\Discipline;
use Webmozart\Assert\Assert;

class DisciplineResource extends Resource
{
    protected static ?string $model = Discipline::class;

    protected static ?string $slug = 'disciplines';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-book';

    public static function getModelLabel(): string
    {
        $label = __('discipline');

        Assert::string($label);

        return $label;
    }

    public static function getPluralModelLabel(): string
    {
        $label = __('disciplines');

        Assert::string($label);

        return $label;
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('data');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('description'),

                ColorPicker::make('color')
                    ->required(),
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

                ColorColumn::make('color'),
            ]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListDisciplines::route('/'),
            'create' => CreateDiscipline::route('/create'),
            'edit' => EditDiscipline::route('/{record}/edit'),
        ];
    }

    /**
     * @return string[]
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
