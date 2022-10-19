<?php

namespace App\Models\Verify;

use App\Models\Caretaker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyCaretaker extends Model
{
    use HasFactory;
    protected $fillable=['caretaker_id', 'otp_code'];

    public function caretaker(){
        return $this->belongsTo(Caretaker::class);
    }
}
