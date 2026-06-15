<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Doctor extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'user_id',
        'license_number',
        'specialization_id',
        'qualification',
        'experience_years',
        'consultation_fee',
        'about',
        'profile_photo',
        'is_available'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    public function schedules()
    {
        return $this->hasMany(
            DoctorSchedule::class
        );
    }
}