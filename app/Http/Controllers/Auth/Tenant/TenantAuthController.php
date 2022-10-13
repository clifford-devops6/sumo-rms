<?php

namespace App\Http\Controllers\Auth\Tenant;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;

use App\Models\Tenant;
use App\Models\Verify\VerifyTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class TenantAuthController extends Controller
{


    //Registration page display
    public function register(){
        return inertia::render('/tenant/auth/register');
    }

    //Tenant login form

    public function  login(){

        return inertia::render('/tenant/auth/login');
    }

    //create tenant user
    public function create(Request $request){

        $validated=$request->validate([
            'name'=>['required', 'string', 'max:255'],
            'last_name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:tenants'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cellphone'=>['required', 'string', 'max:13'],
            'secondary_cellphone'=>['nullable', 'string', 'max:13'],
        ]);

        $tenant=Tenant::create([
            'name'=>$validated['name'],
            'last_name'=>$validated['last_name'],
            'email'=>$validated['email'],
            'cellphone'=>$validated['cellphone'],
            'password'=>Hash::make($validated['password']),
            'tenant_id'=>Str::upper(Str::random(6)),
            'secondary_cellphone'=>$validated['secondary_cellphone'],
            'status'=>0
        ]);

        //create email verification token
        $token=Str::random(60);
        $url=route('tenant.verified', $token);
        $user=$tenant;
        VerifyTenant::create([
            'tenant_id'=>$tenant->id,
            'token'=>$token
        ]);
        //assign role
        $role=Role::findOrFail(4);
        $tenant->assignRole($role);

        Auth::guard('tenant')->login($tenant);
        //event for email verification
        EmailVerify::dispatch($user,$url);
        return redirect('/tenant/resident');
    }

    public function authenticate(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('tenant')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/tenant/resident');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }
}
