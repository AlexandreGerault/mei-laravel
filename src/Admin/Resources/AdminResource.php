<?php

namespace Admin\Resources;

use Admin\Infrastructure\Models\Admin;
use Admin\Resources\AdminResource\Pages;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Hash;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('username')
                ->label(__('username'))
                ->autofocus()
                ->required()
                ->unique(ignoreRecord: true)
                ->placeholder('John Doe'),
            TextInput::make('email')
                ->label(__('email'))
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->placeholder('admin@example.com'),
            TextInput::make('password')
                ->label(__('password'))
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->placeholder('********'),
            FileUpload::make('avatar')
                ->label(__('avatar'))
                ->disk('s3')
                ->visibility('private')
                ->directory('admin-avatars')
                ->image(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->visibility('private')
                    ->disk('s3'),
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
