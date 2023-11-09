<?php

namespace App\Models;

use App\Enums\PatientStatus;
use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientRecord extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => PatientStatus::class
    ];

    public function patient_parents(): BelongsTo {
        return $this->belongsTo(PatientParents::class);
    }

    public function patients(): BelongsTo {
        return $this->belongsTo(Patient::class);
    }

    protected $fillable = [
        'patients',
        'patients_id',
        'patient_parents_id',
        'patient_parents',
        'records',
        'status',
        'visit_date',
    ];
}
