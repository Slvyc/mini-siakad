<?php

namespace App\Filament\Resources\TahunAkademiks\Pages;

use App\Filament\Resources\TahunAkademiks\TahunAkademikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageTahunAkademiks extends ManageRecords
{
    protected static string $resource = TahunAkademikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
