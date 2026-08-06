<?php

namespace App\Filament\Resources\EventSettingResource\Pages;

use App\Filament\Resources\EventSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventSettings extends ListRecords
{
    protected static string $resource = EventSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
