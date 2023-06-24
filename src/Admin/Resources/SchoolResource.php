<?php

namespace Admin\Resources;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Shared\Infrastructure\Laravel\Eloquent\Models\School;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $slug = 'schools';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-school';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->disabled()
                    ->required()
                    ->unique(School::class, 'slug', fn ($record) => $record),

                TextInput::make('logo')
                    ->required(),

                TextInput::make('long_description')
                    ->required(),

                TextInput::make('short_description')
                    ->required(),

                TextInput::make('website')
                    ->required(),

                TextInput::make('city')
                    ->required(),

                TextInput::make('address')
                    ->required(),

                TextInput::make('region')
                    ->required(),

                TextInput::make('department')
                    ->required(),

                Checkbox::make('is_public'),

                TextInput::make('foundation_year')
                    ->required()
                    ->integer(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn (?School $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn (?School $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('logo'),

                TextColumn::make('long_description'),

                TextColumn::make('short_description'),

                TextColumn::make('website'),

                TextColumn::make('city'),

                TextColumn::make('address'),

                TextColumn::make('region'),

                TextColumn::make('department'),

                TextColumn::make('is_public'),

                TextColumn::make('foundation_year'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \Admin\Resources\SchoolResource\Pages\ListSchools::route('/'),
            'create' => \Admin\Resources\SchoolResource\Pages\CreateSchool::route('/create'),
            'edit' => \Admin\Resources\SchoolResource\Pages\EditSchool::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }
}
