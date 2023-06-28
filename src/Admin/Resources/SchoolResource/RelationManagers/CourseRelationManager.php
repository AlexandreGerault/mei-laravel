<?php

namespace Admin\Resources\SchoolResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Webmozart\Assert\Assert;

class CourseRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';

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
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
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
}
