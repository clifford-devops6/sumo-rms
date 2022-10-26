<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\CustomResetPassword;

class Manager extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, HasPermissions;

    protected $fillable=[
        'name',
        'email',
        'password',
        'last_name',
        'manager_id',
        'cellphone',
        'email_verified',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',

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

        $this->notify(new CustomResetPassword($token));
    }

    public function company(){
        return $this->hasOne(Company::class);
    }


}
