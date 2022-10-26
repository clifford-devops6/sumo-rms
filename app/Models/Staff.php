<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Staff extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'password',
        'last_name',
        'staff_id',
        'cellphone',
        'email_verified'
    ];

    public  function company(){
        return $this->belongsTo(Company::class);
    }

}
