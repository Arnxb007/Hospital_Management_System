<?php

namespace App\Models;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use App\Models\MedicalRecord;

class Patient extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function medicalRecords()
    {
        return $this->hasMany(
            MedicalRecord::class
        );
    }
}