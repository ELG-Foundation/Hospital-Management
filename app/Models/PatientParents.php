<?php

namespace App\Models;

use Filament\Forms\Components\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientParents extends Model
{
    use HasFactory;

    public function scopeOwner(Builder $query, PatientParents $patient_parents): void
    {
        $query->where('patient_parents_id', $patient_parents->id);
    }

    public function Patient(): BelongsTo {
        return $this->belongsTo(PatientParents::class, 'patient_parents');
    }

    public function appoinment(): HasMany {
        return $this->hasMany(Appoinment::class);
    }

    public function record(): HasMany {
        return $this->hasMany(PatientRecord::class);
    }

    protected $fillable = [
        'parent_name',
        'parent_mail',
        'parent_number'
    ];
}
