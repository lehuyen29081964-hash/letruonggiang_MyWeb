<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        // Kiểm tra nếu người dùng đã đăng nhập thì chuyển đến Dashboard
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }
        return view('admin.auth.login');
    }

    // Xử lý đăng nhập
    public function postLogin(LoginRequest $request)
    {
        // Thử đăng nhập
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember ?? false)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->withErrors(['login' => 'Sai tên đăng nhập hoặc mật khẩu']);
        }
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        // Đăng xuất user
        Auth::logout();
        
        // Xóa session hiện tại
        $request->session()->invalidate();
        
        // Tạo lại CSRF token mới
        $request->session()->regenerateToken();
        
        // Redirect về trang login
        return redirect()->route('auth.login');
    }

    // Hiển thị giao diện quên mật khẩu
    public function forgotPassword()
    {
        return view('admin.auth.forgotpassword');
    }

    // Xử lý quên mật khẩu
    public function postForgotPassword(Request $request)
    {
        // Implement forgot password logic
    }
}
