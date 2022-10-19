<?php

namespace App\Http\Controllers\Auth\Tenant;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthenticatedTenant extends Controller
{
    //logout tenant

    public function destroy(Request $request){

        Auth::guard('tenant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verify(){
        if (Auth::guard('tenant')->user()->email_verified){
            return  redirect('/tenant/resident');
        }
        return inertia::render('/tenant/auth/verify');
    }

    //verify email
    public function checkVerification(Request $request){
        $validated=$request->validate([
            'otp_code'=>'required|integer|digits:4'
        ]);
        $verifyUser=VerifyTenant::where('otp_code', $validated['otp_code'])->first();
        if(!is_null($verifyUser) ){
            $user=$verifyUser->tenant;
            if(!$user->email_verified) {
                $verifyUser->tenant->email_verified = 1;
                $verifyUser->tenant->save();
                return redirect('/tenant/resident');
            }else{
                return redirect('/tenant/resident');
            }
        }else{
            return  redirect('/tenant/auth/verify')
                ->with('status', 'We could not find the OTP provided in our database');
        }
    }

    //resend verification

    public function resendVerification()
    {
        $verifyUser = VerifyTenant::where('tenant_id', Auth::id())->first();
        if (!$verifyUser) {
            $otp = rand(1111,9999);
            $verifyUser = VerifyTenant::create([
                'tenant_id' => Auth::id(),
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
