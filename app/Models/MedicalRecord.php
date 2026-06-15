<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'diagnosis',
        'prescription',
        'notes',
        'appointment_id'
    ];
       public function doctor()
    {
        return $this->belongsTo(
            \App\Models\Doctor::class
        );
    }

    public function patient()
    {
        return $this->belongsTo(
            \App\Models\Patient::class
        );
    }

    public function appointment()
    {
        return $this->belongsTo(
            \App\Models\Appointment::class
        );
    }
    public function files()
    {
        return $this->hasMany(
            MedicalRecordFile::class
        );
    }
}
