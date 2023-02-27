<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TwoFactorController extends Controller
{
    public function index()
    {
        $identifier = ('2fa.id'.md5(Auth::id()));
        if (Session::has($identifier)){
            return redirect(RouteServiceProvider::HOME);
        }else{
            return inertia('Auth/TwoFactor');

        }
    }

    public function verifyUser()
    {
        $identifier = ('2fa.id'.md5(Auth::id()));
        session([$identifier => hash::make(Auth::id())]);
        return redirect(RouteServiceProvider::HOME);
    }
}
