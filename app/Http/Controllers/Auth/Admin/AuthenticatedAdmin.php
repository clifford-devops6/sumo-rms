<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyUSer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if ($verifiedAdmin=VerifyUSer::where('user_id', Auth::id())->first()){
            return  redirect('/admin/dashboard');
        }
        return inertia::render('/admin/auth/verify');
    }
}
