<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(LoginCustomerRequest $request)
    {
        //dd($request->email);
        $credentials = $request->only('email', 'password');
        //dd(auth()->guard()->validate($credentials));
        if (auth()->guard()->attempt($credentials)) {
            return redirect()->route('home')->with(['success' => 'Авторизован']);
        }
        elseif (auth()->guard('seller')->attempt($credentials)){
            return redirect()->route('home')->with(['success' => 'Авторизован']);
        }
        return back()->withErrors(['msg' => 'Неверный пароль либо пользователь отстуствует']);
    }
    public function logout()
    {
        if (auth()->check())
        {
            auth()->logout();
        }
        elseif (auth()->guard('seller')->check())
        {
            auth()->guard('seller')->logout();
        }
        return view('welcome');
    }
}
