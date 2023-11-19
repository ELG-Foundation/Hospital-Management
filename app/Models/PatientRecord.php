<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientRecord extends Model
{
    use HasFactory;

    public function patient(): BelongsTo {
        return $this->belongsTo(PatientView::class, 'patient_id');
    }

    protected $fillable = [
        'name',
        'number',
        'address',
        'doc_img',
        'patient_id',
    ];
}
