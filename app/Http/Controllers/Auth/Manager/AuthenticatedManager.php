<?php

namespace App\Http\Controllers\Auth\Manager;

use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticatedManager extends Controller
{
    //
    public function destroy(Request $request){
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function verify(){
        if ($verifiedManager=VerifyManager::where('manager_id', Auth::id())->first()){
            return  redirect('/manager/home');
        }
        return inertia::render('/manager/auth/verify');
    }
}
