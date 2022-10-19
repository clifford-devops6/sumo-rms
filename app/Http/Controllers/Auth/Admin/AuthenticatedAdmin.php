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
    public function checkVerification($token){
        $verifyUser=VerifyUser::where('token', $token)->first();
        if(!is_null($verifyUser) ){
            $user=$verifyUser->user;
            if(!$user->email_verified) {
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();
                return redirect('/admin/auth/verify');
            }else{
                return redirect('/admin/dashboard');
            }
        }else{
            return  redirect('/admin/auth/verify');
        }
    }

    //resend email verification

    public function resendVerification()
    {
        $verifyUser = VerifyUser::where('user_id', Auth::id())->first();
        if (!$verifyUser) {
            $token = Str::random(60);
            $verifyUser = VerifyUser::create([
                'user_id' => Auth::id(),
                'token' => $token
            ]);
        }
        //event for email verification
        $user=Auth::user();
        $url=route('admin.verified', $verifyUser->token);
        EmailVerify::dispatch($user,$url);

        return redirect()->back()
            ->with('status', 'OTP Sent Successfully');
    }
}
