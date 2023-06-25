<?php

namespace Admin\Resources\CourseResource\Pages;

use Admin\Resources\CourseResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditCourse extends EditRecord
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
            DeleteAction::make(),
        ];
    }
}
