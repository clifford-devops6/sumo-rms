<?php

namespace App\Http\Controllers\Auth\Manager;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Verify\VerifyManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class ManagerAuthController extends Controller
{

    //Registration page display
    public function register(){

        return inertia::render('manager/auth/register');
    }
//create manager user
    public function create(Request $request){

        $validated=$request->validate([
            'name'=>['required', 'string', 'max:255'],
            'last_name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:managers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cellphone'=>['required', 'string', 'max:13'],
        ]);

        $manager=Manager::create([
            'name'=>$validated['name'],
            'last_name'=>$validated['last_name'],
            'email'=>$validated['email'],
            'cellphone'=>$validated['cellphone'],
            'password'=>Hash::make($validated['password']),
            'manager_id'=>Str::upper(Str::random(6))
        ]);
        //create email verification token
        $otp=rand(1111,9999);
        $user=$manager;
        VerifyManager::create([
            'manager_id'=>$manager->id,
            'otp_code'=>$otp
        ]);
        //assign role
        $role=Role::findOrFail(2);
        $manager->assignRole($role);

        Auth::guard('manager')->login($manager);
        //event for email verification
        EmailVerify::dispatch($user,$otp);
        return redirect('/manager/home');
    }

    public function  login(){

       return inertia::render('/manager/auth/login');
    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('manager')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/manager/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
}
