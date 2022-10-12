<?php

namespace App\Models\Verify;

use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyManager extends Model
{
    use HasFactory;
    protected $fillable=['manager_id', 'token'];

    public function manager(){
        return $this->belongsTo(Manager::class);
    }
}
