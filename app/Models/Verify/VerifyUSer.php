<?php

namespace App\Models\Verify;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUSer extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'token'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
