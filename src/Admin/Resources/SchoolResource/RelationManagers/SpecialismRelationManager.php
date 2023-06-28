<?php

namespace Admin\Resources\SchoolResource\RelationManagers;

use Admin\Resources\SpecialismResource;
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
        return SpecialismResource::form($form);
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
