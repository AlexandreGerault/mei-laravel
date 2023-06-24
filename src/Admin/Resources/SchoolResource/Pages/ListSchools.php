<?php

namespace Admin\Resources\SchoolResource\Pages;

use Admin\Resources\SchoolResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchools extends ListRecords
{
    protected static string $resource = SchoolResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
