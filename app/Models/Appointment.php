<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id', 'doctor_id', 'department_id',
        'appointment_date', 'appointment_time',
        'status', 'notes', 'appointment_number'
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getFormattedTimeAttribute(): string
    {
        return substr($this->appointment_time, 0, 5);
    }

    public static function generateNumber(): string
    {
        $count = self::count() + 1;
        return 'APT-' . date('Y') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}