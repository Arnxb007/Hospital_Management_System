<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecordFile extends Model
{
    protected $fillable = [
        'medical_record_id',
        'file_name',
        'file_path'
    ];
}
