<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id', 
        'appointment_time', 
        'reason', 
        'doctor_comment', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'appointment_time' => 'datetime',
        ];
    }
}