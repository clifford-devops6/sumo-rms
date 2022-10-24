<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable=[
        'name', 'cellphone', 'contact_person_name','manager_id'
    ];

    public function location(){
        return $this->morphOne(Location::class,'location');
    }

    public function manager(){
        return $this->belongsTo(Manager::class);
    }
}
