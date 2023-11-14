<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AppointmentStatus: string implements HasLabel, HasColor
{
    case Approved = 'Approved';
    case Waiting = 'Waiting';
    case NotApproved = 'Not Approved';
    case Delay = 'Delay';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Approved => 'Approved',
            self::Waiting => 'Waiting',
            self::NotApproved => 'Not Approved',
            self::Delay => 'Delay',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Approved => 'success',
            self::Waiting => 'warning',
            self::NotApproved => 'gray',
            self::Delay => 'danger',
        };
    }
}
