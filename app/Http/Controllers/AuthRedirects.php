<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AuthRedirects extends Controller
{
    public function redirecTo()
    {
        if(Auth::check()) {

            if(Auth::user()->utype === 'ADM') {
                return redirect()->route('admin.dashboard');
            }elseif(Auth::user()->utype === 'USR') {
                return redirect()->route('user.dashboard');
            }else {
                session()->flush();
                return redirect()->route('home');
            }

        } else {
            return redirect()->route('home');
        }
        
    }
}
