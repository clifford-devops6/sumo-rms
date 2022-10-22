<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable=[
        'tenant_id','guest_id','unit_id','property_id','appointment_date',
        'appointment_end_date','appointment_status_id','status_reason','appointment_number'
    ];

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }

    public function guest(){
        return $this->belongsTo(Guest::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public  function property(){
        return $this->belongsTo(Property::class);
    }

    public function status(){
        return $this->belongsTo(AppointmentStatus::class);
    }
}
