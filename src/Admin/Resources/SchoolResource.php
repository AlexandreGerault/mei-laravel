<?php

namespace Admin\Resources;

use Admin\Resources\SchoolResource\Pages\CreateSchool;
use Admin\Resources\SchoolResource\Pages\EditSchool;
use Admin\Resources\SchoolResource\Pages\ListSchools;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
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

                FileUpload::make('logo')
                    ->visibility('private')
                    ->disk('s3')
                    ->required(),

                RichEditor::make('long_description')
                    ->required(),

                TextInput::make('short_description')
                    ->required(),

                TextInput::make('website')
                    ->url()
                    ->required(),

                TextInput::make('city')
                    ->required(),

                TextInput::make('address')
                    ->required(),

                TextInput::make('region')
                    ->required(),

                TextInput::make('department')
                    ->required(),

                Toggle::make('is_public'),

                TextInput::make('foundation_year')
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

                ImageColumn::make('logo')
                    ->visibility('private')
                    ->disk('s3'),

                TextColumn::make('short_description'),

                TextColumn::make('website'),

                TextColumn::make('city'),

                TextColumn::make('region'),

                IconColumn::make('is_public')->boolean(),

                TextColumn::make('foundation_year'),
            ]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListSchools::route('/'),
            'create' => CreateSchool::route('/create'),
            'edit' => EditSchool::route('/{record}/edit'),
        ];
    }

    /**
     * @return string[]
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }
}
