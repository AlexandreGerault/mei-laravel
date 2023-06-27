<?php

namespace Admin\Resources;

use Admin\Resources\AdmissionResource\Pages\CreateAdmission;
use Admin\Resources\AdmissionResource\Pages\EditAdmission;
use Admin\Resources\AdmissionResource\Pages\ListAdmissions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Shared\Infrastructure\Laravel\Eloquent\Models\Admission;
use Webmozart\Assert\Assert;

class AdmissionResource extends Resource
{
    protected static ?string $model = Admission::class;

    protected static ?string $slug = 'admissions';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'fas-trophy';

    public static function getModelLabel(): string
    {
        $label = __('admission');

        Assert::string($label);

        return $label;
    }

    public static function getPluralModelLabel(): string
    {
        $label = __('admissions');

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
                    ->label(__('name'))
                    ->required(),

                TextInput::make('description')
                    ->label(__('description'))
                    ->required(),

                Select::make('pathway')
                    ->label(__('pathway'))
                    ->relationship('pathway', 'name')
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

                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pathway.name')
                    ->searchable()
                    ->sortable(),
            ]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListAdmissions::route('/'),
            'create' => CreateAdmission::route('/create'),
            'edit' => EditAdmission::route('/{record}/edit'),
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
