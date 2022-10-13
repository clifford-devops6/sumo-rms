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
    public function checkVerification($token){
        $verifyUser=VerifyTenant::where('token', $token)->first();
        if(!is_null($verifyUser) ){
            $user=$verifyUser->tenant;
            if(!$user->email_verified) {
                $verifyUser->tenant->email_verified = 1;
                $verifyUser->tenant->save();
                return redirect('/tenant/auth/verify');
            }else{
                return redirect('/tenant/resident');
            }
        }else{
            return  redirect('/tenant/auth/verify');
        }
    }

    //resend verification

    public function resendVerification()
    {
        $verifyUser = VerifyTenant::where('tenant_id', Auth::id())->first();
        if (!$verifyUser) {
            $token = Str::random(60);
            $verifyUser = VerifyTenant::create([
                'tenant_id' => Auth::id(),
                'token' => $token
            ]);
        }

        //event for email verification
        $user=Auth::user();
        $url=route('tenant.verified', $verifyUser->token);
        EmailVerify::dispatch($user,$url);
    }
}
