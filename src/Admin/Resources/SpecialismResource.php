<?php

namespace Admin\Resources;

use Admin\Resources\SpecialismResource\Pages\CreateSpecialism;
use Admin\Resources\SpecialismResource\Pages\EditSpecialism;
use Admin\Resources\SpecialismResource\Pages\ListSpecialisms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Shared\Infrastructure\Laravel\Eloquent\Models\Specialism;

class SpecialismResource extends Resource
{
    protected static ?string $model = Specialism::class;

    protected static ?string $slug = 'specialisms';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-tags';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('description'),

                Select::make('discipline')
                    ->relationship('discipline', 'name')
                    ->preload(),

                Select::make('school')
                    ->relationship('school', 'name')
                    ->preload(),

                Select::make('courses')
                    ->relationship('courses', 'name')
                    ->preload()
                    ->multiple(),

                Select::make('industries')
                    ->relationship('industries', 'name')
                    ->preload()
                    ->multiple(),
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
            ]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListSpecialisms::route('/'),
            'create' => CreateSpecialism::route('/create'),
            'edit' => EditSpecialism::route('/{record}/edit'),
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
