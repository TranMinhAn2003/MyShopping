<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index()
    {
        return view ('auth.login');
    }
    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')

        ];
        if (Auth::attempt($credentials)) {
               flash()->success('Đăng nhập thành công');
            return redirect()->route('dashboard.index');
        }
               flash()->error('Email hoặc mật khẩu không chính xác');
        return redirect()->route('index');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
