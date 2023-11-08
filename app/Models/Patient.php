<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;


class Patient extends Model
{
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;

    public function patient_parents(): BelongsTo {
        return $this->belongsTo(PatientParents::class);
    }

    public function appoinment(): HasMany {
        return $this->hasMany(Appoinment::class);
    }

    public function record(): HasMany {
        return $this->hasMany(PatientRecord::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_name',
        'patient_age',
        'patient_dob',
        'description',
        'patient_parents_id',
        'patient_parents'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
