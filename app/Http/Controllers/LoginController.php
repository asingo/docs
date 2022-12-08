<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUser;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $redirectTo = '/docs';

    public function __construct()
    {
        $this->middleware('guest')->except('actionLogout');
    }

    public function login()
    {
        if (Auth::check()) {
            if (auth()->user()->role === "Administrator") {
                return redirect('home');
            } else {
                return redirect('docs');
            }
        } else {
            return view('login');
        }
    }

    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::attempt($data)) {
            if (auth()->user()->role === "Administrator") {
                return redirect('home');
            } else {
                return redirect('docs');
            }
        } else {
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
