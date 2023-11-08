<?php

namespace App\Filament\Resources\PatientParentsResource\Pages;

use App\Filament\Resources\PatientParentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPatientParents extends EditRecord
{
    protected static string $resource = PatientParentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
