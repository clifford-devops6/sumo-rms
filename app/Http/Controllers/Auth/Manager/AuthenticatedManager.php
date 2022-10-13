<?php

namespace App\Http\Controllers\Auth\Manager;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        if (Auth::guard('manager')->user()->email_verified){
            return  redirect('/manager/home');
        }
        return inertia::render('/manager/auth/verify');
    }

    //verify email
    public function checkVerification($token){
        $verifyUser=VerifyManager::where('token', $token)->first();
        if(!is_null($verifyUser) ){
            $user=$verifyUser->manager;
            if(!$user->email_verified) {
                $verifyUser->manager->email_verified = 1;
                $verifyUser->manager->save();
                return redirect('/manager/auth/verify');
            }else{
                return redirect('/manager/home');
            }
        }else{
            return  redirect('/manager/auth/verify');
        }
    }

    //resend verification

    public function resendVerification()
    {
        $verifyUser = VerifyManager::where('manager_id', Auth::id())->first();
        if (!$verifyUser) {
            $token = Str::random(60);
            $verifyUser = VerifyManager::create([
                'manager_id' => Auth::id(),
                'token' => $token
            ]);
        }

        //event for email verification
        $user=Auth::user();
        $url=route('manager.verified', $verifyUser->token);
        EmailVerify::dispatch($user,$url);
    }
}
