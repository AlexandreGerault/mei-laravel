<?php

namespace Admin\Resources;

use Admin\Resources\CourseResource\Pages\CreateCourse;
use Admin\Resources\CourseResource\Pages\EditCourse;
use Admin\Resources\CourseResource\Pages\ListCourses;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Shared\Infrastructure\Laravel\Eloquent\Models\Course;
use Webmozart\Assert\Assert;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $slug = 'courses';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-briefcase';

    public static function getModelLabel(): string
    {
        $label = __('course');

        Assert::string($label);

        return $label;
    }

    public static function getPluralModelLabel(): string
    {
        $label = __('courses');

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
                    ->label(__('description')),

                Select::make('specialisms')
                    ->label(__('specialisms'))
                    ->relationship('specialisms', 'name')
                    ->preload()
                    ->multiple(),
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
            ]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListCourses::route('/'),
            'create' => CreateCourse::route('/create'),
            'edit' => EditCourse::route('/{record}/edit'),
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
        return __('schools');
    }
}
