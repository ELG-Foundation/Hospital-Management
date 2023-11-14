<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appoinment extends Model
{
    use HasFactory;

    public function patient_parents(): BelongsTo {
        return $this->belongsTo(PatientParents::class);
    }

    public function patients(): BelongsTo {
        return $this->belongsTo(Patient::class);
    }

    protected $fillable = [
        'parent_name',
        'status',
        'parent_number',
        'patient_parents',
        'patient_name',
        'patient_parents_id',
        'appoinment_date',
    ];
}
