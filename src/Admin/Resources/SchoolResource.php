<?php

namespace Admin\Resources;

use Admin\Resources\SchoolResource\Pages\CreateSchool;
use Admin\Resources\SchoolResource\Pages\EditSchool;
use Admin\Resources\SchoolResource\Pages\ListSchools;
use Admin\Resources\SchoolResource\RelationManagers\CourseRelationManager;
use Admin\Resources\SchoolResource\RelationManagers\SpecialismRelationManager;
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
use Webmozart\Assert\Assert;

class SchoolResource extends Resource
{
    protected static ?int $navigationSort = 1;

    protected static ?string $model = School::class;

    protected static ?string $slug = 'schools';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-school';

    public static function getModelLabel(): string
    {
        $label = __('school');

        Assert::string($label);

        return $label;
    }

    public static function getPluralModelLabel(): string
    {
        $label = __('schools');

        Assert::string($label);

        return $label;
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('schools');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('name'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->label(__('slug'))
                    ->disabled()
                    ->required()
                    ->unique(School::class, 'slug', fn ($record) => $record),

                FileUpload::make('logo')
                    ->image()
                    ->label(__('logo'))
                    ->visibility('private')
                    ->disk('s3')
                    ->required(),

                RichEditor::make('long_description')
                    ->label(__('long_description'))
                    ->required(),

                TextInput::make('short_description')
                    ->label(__('short_description'))
                    ->required(),

                TextInput::make('website')
                    ->label(__('website'))
                    ->url()
                    ->required(),

                TextInput::make('city')
                    ->label(__('city'))
                    ->required(),

                TextInput::make('address')
                    ->label(__('address'))
                    ->required(),

                TextInput::make('region')
                    ->label(__('region'))
                    ->required(),

                TextInput::make('department')
                    ->label(__('department'))
                    ->required(),

                Toggle::make('is_public')
                    ->label(__('is_public')),

                TextInput::make('foundation_year')
                    ->label(__('foundation_year'))
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
     * @return class-string[]
     */
    public static function getRelations(): array
    {
        return [
            SpecialismRelationManager::class,
            CourseRelationManager::class,
        ];
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
