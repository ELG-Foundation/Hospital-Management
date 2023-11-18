<?php
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
 
enum BloodType: string implements HasLabel
{
    case APlus = 'A+';
    case AMinus = 'A-';
    case BPlus = 'B+';
    case BMinus = 'B-';
    case ABPlus = 'AB+';
    case ABMinus = 'AB-';
    case OPlus = 'O+';
    case OMinus = 'O-';
    
    public function getLabel(): ?string
    {
        return match ($this) {
            self::APlus => 'A+',
            self::AMinus => 'A-',
            self::BPlus => 'B+',
            self::BMinus => 'B-',
            self::ABPlus => 'AB+',
            self::ABMinus => 'AB-',
            self::OPlus => 'O+',
            self::OMinus => 'O-',
        };
    }
}