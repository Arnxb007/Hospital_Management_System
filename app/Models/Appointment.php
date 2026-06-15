<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [

        'patient_id',
        'doctor_id',

        'appointment_date',
        'appointment_time',

        'status',
        'reason',

        'consultation_fee',

        'payment_status',
        'payment_id',
        'razorpay_order_id',
        'amount_paid',

        'notes'
    ];
    protected $attributes = [

        'status' => 'pending',

        'payment_status' => 'pending'
    ];
    protected $casts = [

        'appointment_date' => 'date',

        'paid_at' => 'datetime',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}