<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PatientStatus: string implements HasLabel, HasColor
{
    case Admitted = 'Admitted';
    case Discharged = 'discharged';
    case OnTreatment = 'Discharged';
    case Home = 'Home';
    case Emergency = 'Emergency';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admitted => 'Admitted',
            self::Discharged => 'Discharged',
            self::OnTreatment => 'On Treatment',
            self::Home => 'Home',
            self::Emergency => 'Emergency',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Discharged => 'gray',
            self::Admitted => 'warning',
            self::Home => 'success',
            self::OnTreatment => 'primary',
            self::Emergency => 'danger',
        };
    }
}
