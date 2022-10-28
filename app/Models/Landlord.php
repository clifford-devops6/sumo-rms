<?php

namespace App\Models;

use App\Notifications\LandlordPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Landlord extends Authenticatable
{
    use HasFactory,Notifiable, HasApiTokens, HasRoles, HasPermissions;

    protected $fillable=[
        'name',
        'email',
        'password',
        'last_name',
        'landlord_id',
        'cellphone',
        'email_verified',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {

        $this->notify(new LandlordPasswordNotification($token));
    }


}
