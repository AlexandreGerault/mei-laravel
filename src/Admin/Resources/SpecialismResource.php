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
use Webmozart\Assert\Assert;

class SpecialismResource extends Resource
{
    use CountNavigationLabel;

    protected static ?int $navigationSort = 3;

    protected static ?string $model = Specialism::class;

    protected static ?string $slug = 'specialisms';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-tags';

    public static function getModelLabel(): string
    {
        $label = __('specialism');

        Assert::string($label);

        return $label;
    }

    public static function getPluralModelLabel(): string
    {
        $label = __('specialisms');

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
                    ->required(),

                TextInput::make('description')
                    ->label(__('description')),

                Select::make('discipline')
                    ->label(__('discipline'))
                    ->relationship('discipline', 'name')
                    ->preload(),

                Select::make('school')
                    ->label(__('school'))
                    ->relationship('school', 'name')
                    ->preload(),

                Select::make('courses')
                    ->label(__('courses'))
                    ->relationship('courses', 'name')
                    ->preload()
                    ->multiple(),

                Select::make('industries')
                    ->label(__('industries'))
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
