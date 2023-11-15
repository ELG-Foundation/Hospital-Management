<?php

namespace App\Filament\Resources\PatientViewResource\Pages;

use App\Filament\Resources\PatientViewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientView extends EditRecord
{
    protected static string $resource = PatientViewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
