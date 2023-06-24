<?php

namespace Admin\Resources\AdmissionResource\Pages;

use Admin\Resources\AdmissionResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditAdmission extends EditRecord
{
    protected static string $resource = AdmissionResource::class;

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
