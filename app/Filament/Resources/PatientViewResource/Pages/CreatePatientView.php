<?php

namespace App\Filament\Resources\PatientViewResource\Pages;

use App\Filament\Resources\PatientViewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePatientView extends CreateRecord
{
    protected static string $resource = PatientViewResource::class;
}
