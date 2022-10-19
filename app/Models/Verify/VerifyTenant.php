<?php

namespace App\Models\Verify;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyTenant extends Model
{
    use HasFactory;

    protected $fillable=['tenant_id', 'otp_code'];

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }
}
