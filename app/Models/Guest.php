<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Guest extends Model
{
    use HasFactory;

    protected $fillable=[
        'name', 'identification_type','identification_number',
        'email_address','cellphone_one','cellphone_two','address','vehicle_reg',
        'tenant_id'
    ];

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }


}
