<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel
{
    case Admitted = 'admitted';
    case Discharged = 'discharged';
    case OnTreatment = 'ontreatment';
    case Home = 'home';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admitted => 'Admitted',
            self::Discharged => 'Discharged',
            self::OnTreatment => 'OnTreatment',
            self::Home => 'Home',
        };
    }

    // public function getColor(): string | array | null
    // {
    //     return match ($this) {
    //         self::Discharged => 'gray',
    //         self::Admitted => 'warning',
    //         self::Home => 'success',
    //         self::OnTreatment => 'danger',
    //     };
    // }
}
