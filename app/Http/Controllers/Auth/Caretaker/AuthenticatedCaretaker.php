<?php

namespace App\Http\Controllers\Auth\Caretaker;

use App\Http\Controllers\Controller;
use App\Models\Verify\VerifyCaretaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticatedCaretaker extends Controller
{
    //logout caretaker

    public function destroy(Request $request){

        Auth::guard('caretaker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verify(){
        if ($verifiedCaretaker=VerifyCaretaker::where('caretaker_id', Auth::id())->first()){
            return  redirect('/caretaker/public');
        }
        return inertia::render('/caretaker/auth/verify');
    }
}
