<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthenticatedAdmin extends Controller
{
    //
    public function destroy(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verify(){
        if (Auth::guard('web')->user()->email_verified){
            return  redirect('/admin/dashboard');
        }
        return inertia::render('/admin/auth/verify');
    }

    //verify email
    public function checkVerification(Request $request){

        $validated=$request->validate([
            'otp_code'=>'required|integer|digits:4'
        ]);
        $verifyUser=VerifyUser::where('otp_code', $validated['otp_code'])->first();
        if(!is_null($verifyUser) ){
            $user=$verifyUser->user;
            if(!$user->email_verified) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin/dashboard');
            }
        }else{
            return  redirect('/admin/auth/verify')
                ->with('status', 'We could not find the OTP provided in our database');
        }
    }

    //resend email verification

    public function resendVerification()
    {
        $verifyUser = VerifyUser::where('user_id', Auth::id())->first();
        if (!$verifyUser) {
            $otp = rand(1111,9999);;
            $verifyUser = VerifyUser::create([
                'user_id' => Auth::id(),
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
