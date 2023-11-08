<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appoinment extends Model
{
    use HasFactory;

    public function parent(): BelongsTo {
        return $this->belongsTo(PatientParents::class);
    }
}
