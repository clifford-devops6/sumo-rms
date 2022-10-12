<?php

namespace App\Http\Controllers\Auth\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if ($verifiedTenant=VerifyTenant::where('tenant_id', Auth::id())->first()){
            return  redirect('/tenant/resident');
        }
        return inertia::render('/tenant/auth/verify');
    }
}
