<?php

namespace Admin\Resources\SpecialismResource\Pages;

use Admin\Resources\SpecialismResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Actions\BaseAction;

class EditSpecialism extends EditRecord
{
    protected static string $resource = SpecialismResource::class;

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
