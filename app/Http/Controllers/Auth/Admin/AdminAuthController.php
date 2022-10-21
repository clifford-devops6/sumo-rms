<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verify\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class AdminAuthController extends Controller
{


    public function login(){
        return inertia::render('admin/auth/login');
    }
    public function register(){
        return inertia::render('admin/auth/register');
    }

    public function create(Request $request){
        $validated=$request->validate([
            'name'=>['required', 'string', 'max:255'],
            'last_name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user=User::create([
          'name'=>$validated['name'],
            'last_name'=>$validated['last_name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);
        //create email verification token
        $token=rand(1111,9999);;
        VerifyUser::create([
            'user_id'=>$user->id,
            'otp_code'=>$token
        ]);
        //assign role
        $role=Role::findById(1);
        $user->assignRole($role);

        Auth::login($user);
        //event for email verification
        EmailVerify::dispatch($user,$token);
        return redirect('admin/dashboard');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }




}
