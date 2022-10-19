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
        if (Auth::guard('landlord')->user()->email_verified){
            return  redirect('/landlord/portfolio');
        }
        return Inertia::render('/landlord/auth/verify')
            ->with('status','A fresh verification link has been sent to your email address.');
    }

    //verify email
    public function checkVerification(Request $request){
        $validated=$request->validate([
            'otp_code'=>'required|integer|digits:4'
        ]);
      $verifyUser=VerifyLandLord::where('otp_code', $validated['otp_code'])->first();
        if(!is_null($verifyUser) ){
            $landlord=$verifyUser->landlord;
            if(!$landlord->email_verified) {
                $verifyUser->landlord->email_verified = 1;
                $verifyUser->landlord->save();
                return redirect('/landlord/portfolio');
            }else{
                return redirect('/landlord/portfolio');
            }
        }else{
            return  redirect('/landlord/auth/verify')
                ->with('status', 'We could not find the OTP provided in our database');
        }
    }

    //resend email verification

    public function resendVerification(){
     $verifyLandlord=VerifyLandLord::where('landlord_id', Auth::id())->first();
     if (!$verifyLandlord){
         $otp=rand(1111,9999);
         $verifyLandlord= VerifyLandLord::create([
             'landlord_id'=>Auth::id(),
             'otp_code'=>$otp
         ]);
     }

        //event for email verification
        $user=Auth::user();
        $otp= $verifyLandlord->otp_code;
        EmailVerify::dispatch($user,$otp);
        return redirect()->back()
            ->with('status', 'OTP Sent Successfully');

    }
}
