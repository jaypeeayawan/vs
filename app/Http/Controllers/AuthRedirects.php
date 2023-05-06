<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthRedirects extends Controller
{
    public function redirecTo()
    {
        var_dump(Auth::user());
        if(Auth::check()) {
            if(Auth::user()->utype === 'ADM') {
                return redirect()->route('admin.dashboard');
            }elseif(Auth::user()->utype === 'USR') {
                return redirect()->route('user.dashboard');
            }else {
                session()->flush();
                return redirect()->route('login');
            }

        } else {
            return redirect()->route('login');
        }
        
    }
}
