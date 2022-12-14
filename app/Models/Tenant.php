<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Tenant extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, HasPermissions;

    protected $fillable=[
        'name',
        'email',
        'password',
        'last_name',
        'tenant_id',
        'type_id',
        'cellphone',
        'secondary_cellphone',
        'status',
        'email_verified'

    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verified'

    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function guests(){
        return $this->hasMany(Guest::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }


}
