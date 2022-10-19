<?php

namespace App\Http\Controllers\Api;

use App\Events\EmailVerify;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\OTPCodeRequest;
use App\Http\Requests\Tenant\TenantLoginRequest;
use App\Http\Requests\Tenant\TenantRegisterRequest;
use App\Http\Requests\Tenant\TenantUpdateRequest;
use App\Models\Tenant;
use App\Models\Verify\VerifyTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class TenantApiController extends Controller
{
    //

    public function register(TenantRegisterRequest $request)
    {
        $tenant=Tenant::create([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'cellphone'=>$request->cellphone,
            'password'=>Hash::make($request->password),
            'tenant_id'=>Str::upper(Str::random(6)),
            'secondary_cellphone'=>$request->secondary_cellphone,
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

        //event for email verification
        EmailVerify::dispatch($user,$url);
        return response()
            ->json(
                [
                    'message' => 'Registration Successful. Please check you email to verify your account',
                    'user'=>$tenant
                ],
                200);

    }


    public function login(TenantLoginRequest $request){

        $tenant=Tenant::where('email',$request->email)->first();


        //Check if user is verified!
        if ($tenant){
             if (!$tenant->email_verified){
                 //send verification email to user and abort authentication
                 //create email verification token
                 $token=Str::random(60);
                 $url=route('tenant.verified', $token);
                 $user=$tenant;
                 VerifyTenant::create([
                     'tenant_id'=>$tenant->id,
                     'token'=>$token
                 ]);
                 EmailVerify::dispatch($user,$url);
                 return  response()
                     ->json(
                         ['message' => 'User account not verified. Please check your email to verify account'],
                         200);
             }
        }else{
            return  response()
                ->json(
                    ['message' => 'The user does exist in our records'],
                    404);
        }

        //check if the credentials match!

        if (Hash::check($request->password, $tenant->password)){
            return response()
                ->json([
                    'message' => 'Login Success!',
                    'user'=>$tenant
                ], 200);
        }else{
            return  response()
                ->json(
                    ['message' => 'The provided credentials do not match our records.'],
                    401);
        }





    }

    public function update(TenantUpdateRequest $request,$id){
      //Update Except email:
        $tenant=Tenant::find($id);
        if ($tenant){
            $tenant->update($request->all());
            return response()
                ->json([
                    'message'=>'User Updated Successfully',
                    'user'=>$tenant
                ], 200);
        }else{
            return response()
                ->json([
                    'message'=>'User does not exist in our database'
                ], 404);
        }

    }

    public function verification($id){
        //When user requests for a verification email

        $tenant=Tenant::find($id);
        if ($tenant){
            $verifyUser = VerifyTenant::where('tenant_id', $tenant->id)->first();
            if (!$verifyUser) {
                $otp_code = rand(1111,9999);
                $verifyUser = VerifyTenant::create([
                    'tenant_id' => $id,
                    'otp_code' => $otp_code
                ]);
            }

            //event for email verification
            $user=$tenant;
            $otp_code=$verifyUser->otp_code;
            EmailVerify::dispatch($user,$otp_code);
            return response()
                ->json([
                    'message'=>'Email Verification Successfully sent'
                ], 200);
        }else{
            return response()
                ->json([
                    'message'=>'User does not exist in our database'
                ], 404);
        }
    }


    public function verifyUser(OTPCodeRequest $request, $id){
        $tenant=Tenant::find($id);
        if ($tenant){
            $verifyUser = VerifyTenant::where('tenant_id', $tenant->id)->where('otp_code', $request->otp_code)->first();
            if ($verifyUser) {

              $tenant->update(['email_verified'=>1]);
                return response()
                    ->json([
                        'message'=>'User verified Successfully'
                    ], 200);
            }else{
                return response()
                    ->json([
                        'message'=>'OTP Code not found in our databases'
                    ], 404);
            }

        }else{
            return response()
                ->json([
                    'message'=>'User does not exist in our database'
                ], 404);
        }

    }

}
