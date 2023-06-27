<?php

namespace Admin\Resources;

use Admin\Resources\AdminResource\Pages;
use Admin\Resources\IndustryResource\Pages\CreateIndustry;
use Admin\Resources\IndustryResource\Pages\ListIndustries;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Shared\Infrastructure\Laravel\Eloquent\Models\Industry;
use Webmozart\Assert\Assert;

class IndustryResource extends Resource
{
    protected static ?string $model = Industry::class;

    protected static ?string $navigationIcon = 'fas-person-digging';

    public static function getModelLabel(): string
    {
        $label = __('industry');

        Assert::string($label);

        return $label;
    }

    public static function getPluralModelLabel(): string
    {
        $label = __('industries');

        Assert::string($label);

        return $label;
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('data');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label(__('name'))
                ->required(),
            TextInput::make('description')
                ->label(__('description')),
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
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * @return array<string, string[]>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListIndustries::route('/'),
            'create' => CreateIndustry::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
