<?php

namespace App\Filament\Resources\JadwalKkns\Pages;

use App\Filament\Resources\JadwalKkns\JadwalKknResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageJadwalKkns extends ManageRecords
{
    protected static string $resource = JadwalKknResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
