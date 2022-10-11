<?php

namespace App\Http\Controllers\Auth\Caretaker;

use App\Http\Controllers\Controller;
use App\Models\Caretaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class CaretakerAuthController extends Controller
{


    //display caretaker registration page

    public function register(){
        return inertia::render('caretaker/auth/register');
    }

    //display caretaker login page
    public function  login(){

        return inertia::render('caretaker/auth/login');
    }
    //create caretaker user
    public function create(Request $request){

        $validated=$request->validate([
            'name'=>['required', 'string', 'max:255'],
            'last_name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:managers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cellphone'=>['required', 'string', 'max:13'],
        ]);

        $caretaker=Caretaker::create([
            'name'=>$validated['name'],
            'last_name'=>$validated['last_name'],
            'email'=>$validated['email'],
            'cellphone'=>$validated['cellphone'],
            'password'=>Hash::make($validated['password']),
            'caretaker_id'=>Str::upper(Str::random(6))
        ]);
        $role=Role::findOrFail(3);
        $caretaker->assignRole($role);

        Auth::guard('caretaker')->login($caretaker);
        return redirect('/caretaker/public');
    }

    //login caretaker here
    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('caretaker')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/caretaker/public');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
}
