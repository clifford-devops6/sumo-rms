<?php

namespace App\Models\Verify;

use App\Models\Landlord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyLandLord extends Model
{
    use HasFactory;
    protected $fillable=['landlord_id', 'otp_code'];

    public function landlord(){
        return $this->belongsTo(Landlord::class);
    }
}
