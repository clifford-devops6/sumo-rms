<?php

namespace App\Http\Controllers\Auth\Caretaker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedCaretaker extends Controller
{
    //logout caretaker

    public function destroy(Request $request){

        Auth::guard('caretaker')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
