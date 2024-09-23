<?php

namespace App\Http\Controllers\Backend;

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
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra role của người dùng
            if ($user->role == '1') {
                flash()->success('Đăng nhập thành công');
                return redirect()->route('dashboard.index');
            } else {
                if(Auth::user()->status==0 && Auth::user()->role==0) {

                    Auth::logout();
                    flash()->error('Tài khoản chưa được kích hoạt');
                    return redirect()->route('index');
                }
                else{
                    flash()->success('Đăng nhập thành công');
                    return redirect()->route('home.index');
                }

            }
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
