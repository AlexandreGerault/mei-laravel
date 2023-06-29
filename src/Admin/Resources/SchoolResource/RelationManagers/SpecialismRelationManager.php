<?php

namespace Admin\Resources\SchoolResource\RelationManagers;

use Admin\Resources\SpecialismResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Webmozart\Assert\Assert;

class SpecialismRelationManager extends RelationManager
{
    protected static string $relationship = 'specialisms';

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
        return $table->columns([
            TextColumn::make('name')
                ->label(__('name')),
            TextColumn::make('description')
                ->label(__('description'))
        ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
