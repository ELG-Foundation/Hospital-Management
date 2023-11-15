<?php

namespace App\Filament\Resources\PatientViewResource\Pages;

use App\Filament\Resources\PatientViewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatientViews extends ListRecords
{
    protected static string $resource = PatientViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
