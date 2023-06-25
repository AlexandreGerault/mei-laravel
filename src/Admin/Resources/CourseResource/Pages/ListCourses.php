<?php

namespace Admin\Resources\CourseResource\Pages;

use Admin\Resources\CourseResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Actions\BaseAction;
use Filament\Tables\Actions\DeleteAction;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    /**
     * @return array<array-key, BaseAction>
     *
     * @throws \Exception
     */
    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    /**
     * @return array<array-key, BaseAction>
     *
     * @throws \Exception
     */
    protected function getTableActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
