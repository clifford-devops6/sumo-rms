<?php

namespace App\Http\Controllers\Auth\Landlord;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\Landlord;
use App\Models\Verify\VerifyLandLord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthenticatedLandlord extends Controller
{
    //
    public function destroy(Request $request){
        Auth::guard('landlord')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verify(){
        if ($verifiedLandlord=VerifyLandLord::where('landlord_id', Auth::id())->first()){
            return  redirect('/landlord/portfolio');
        }
        return Inertia::render('/landlord/auth/verify')
            ->with('status','A fresh verification link has been sent to your email address.');
    }

    //verify email
    public function checkVerification($token){
      $verifyUser=VerifyLandLord::where('token', $token)->first();
        if(!is_null($verifyUser) ){
            $landlord=$verifyUser->landlord;
            if(!$landlord->email_verified) {
                $verifyUser->landlord->email_verified = 1;
                $verifyUser->landlord->save();
                return redirect('/landlord/auth/verify');
            }else{
                return redirect('/landlord/portfolio');
            }
        }else{
            return  redirect('/landlord/auth/verify');
        }
    }

    //resend email verification

    public function resendVerification(){
     $verifyLandlord=VerifyLandLord::where('landlord_id', Auth::id())->first();
     if (!$verifyLandlord){
         $token=Str::random(60);
         $verifyLandlord= VerifyLandLord::create([
             'landlord_id'=>Auth::id(),
             'token'=>$token
         ]);
     }

        //event for email verification
        $user=Auth::user();
        $url=route('landlord.verified', $verifyLandlord->token);
        EmailVerify::dispatch($user,$url);

    }
}
