<?php

namespace Admin\Resources\IndustryResource\Pages;

use Admin\Resources\IndustryResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditIndustry extends EditRecord
{
    protected static string $resource = IndustryResource::class;

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
