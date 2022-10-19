<?php

namespace App\Http\Controllers\Auth\Caretaker;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyCaretaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthenticatedCaretaker extends Controller
{
    //logout caretaker

    public function destroy(Request $request){

        Auth::guard('caretaker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verify(){
        if (Auth::guard('caretaker')->user()->email_verified){
            return  redirect('/caretaker/public');
        }
        return inertia::render('/caretaker/auth/verify');
    }

    //verify email
    public function checkVerification(Request $request){
        $validated=$request->validate([
            'otp_code'=>'required|integer|digits:4'
        ]);
        $verifyUser=VerifyCaretaker::where('otp_code', $validated['otp_code'])->first();
        if(!is_null($verifyUser) ){
            $caretaker=$verifyUser->caretaker;
            if(!$caretaker->email_verified) {
                $verifyUser->caretaker->email_verified = 1;
                $verifyUser->caretaker->save();
                return redirect('/caretaker/public');
            }else{
                return redirect('/caretaker/public')
                    ->with('status', 'We could not find the OTP provided in our database');
            }
        }else{
            return  redirect('/caretaker/auth/verify');
        }
    }

    //resend verification

    public function resendVerification()
    {
        $verifyUser = VerifyCaretaker::where('caretaker_id', Auth::id())->first();
        if (!$verifyUser) {
            $otp =rand(1111,9999);
            $verifyUser = VerifyCaretaker::create([
                'caretaker_id' => Auth::id(),
                'otp_code' => $otp
            ]);
        }
        //event for email verification
        $user=Auth::user();
        $otp=$verifyUser->otp_code;
        EmailVerify::dispatch($user,$otp);
        return redirect()->back()
            ->with('status', 'OTP Sent Successfully');
    }
}
