<?php

namespace App\Http\Controllers\Auth\Landlord;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;

use App\Models\Landlord;
use App\Models\Verify\VerifyLandLord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class LandlordAuthController extends Controller
{
    //
    //Registration page display
    public function register(){

        return inertia::render('landlord/auth/register');
    }
//create landlord user
    public function create(Request $request){

        $validated=$request->validate([
            'name'=>['required', 'string', 'max:255'],
            'last_name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:landlords'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cellphone'=>['required', 'string', 'max:13'],
        ]);

        $landlord=Landlord::create([
            'name'=>$validated['name'],
            'last_name'=>$validated['last_name'],
            'email'=>$validated['email'],
            'cellphone'=>$validated['cellphone'],
            'password'=>Hash::make($validated['password']),
            'landlord_id'=>Str::upper(Str::random(6))
        ]);
        //create email verification token
        $token=Str::random(60);
        $url=route('landlord.verified', $token);
        $user=$landlord;
        VerifyLandLord::create([
            'landlord_id'=>$landlord->id,
            'token'=>$token
        ]);
       //Assign role
        $role=Role::findOrFail(5);
        $landlord->assignRole($role);
        Auth::guard('landlord')->login($landlord);



        //event for email verification
       EmailVerify::dispatch($user,$url);

        return redirect('/landlord/portfolio');
    }

    public function  login(){

        return inertia::render('/landlord/auth/login');
    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('landlord')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/landlord/portfolio');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
}
