<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Location extends Model
{
    use HasFactory;

    protected  $fillable=[
        'country_id','city','street_address','locationable_id','locationable_type'
    ];

    public function location(){
        return $this->morphTo();
    }

}
