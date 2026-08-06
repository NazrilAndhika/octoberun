<?php

namespace App\Filament\Resources\EventSettingResource\Pages;

use App\Filament\Resources\EventSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventSetting extends EditRecord
{
    protected static string $resource = EventSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
