<?php

namespace App\Http\Controllers\Auth\Caretaker;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Validation\Rules;

class CaretakerPasswordReset extends Controller
{


    protected function guard()
    {
        return Auth::guard('manager');
    }

    public function reset(){
        return inertia::render('/caretaker/auth/forgot-password');
    }

    //store password reset token and email. use "caretaker" as password broker
    public function store(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
        ]);



        $status = Password::broker('caretakers')->sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }


    //password update page
    public function create(Request $request){

        return inertia::render('/caretaker/auth/reset-password',
            [
                'request' => $request,
                'code'=>$request->token,
            ]);


    }


    //update the password as provided by the user
    public function update (Request $request){
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::broker('caretakers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {

                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('caretaker.login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
