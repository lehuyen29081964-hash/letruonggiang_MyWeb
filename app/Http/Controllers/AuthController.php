<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        // Kiểm tra nếu người dùng đã đăng nhập thì chuyển đến Dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    // Xử lý đăng nhập
    public function postLogin(LoginRequest $request)
    {
        // Thử đăng nhập
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember ?? false)) {
            return redirect()->route('admin.dashboard');
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
        return redirect()->route('admin.login');
    }

    // Hiển thị giao diện quên mật khẩu
    public function forgotPassword()
    {
        return view('admin.auth.forgotpassword');
    }

    // Xử lý quên mật khẩu
    public function postForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email không tồn tại')->withInput();
        }

        $passrandom = Str::random(10);
        $passencrypted = Hash::make($passrandom);
        $user->update([
            'password' => $passencrypted,
        ]);

        $html = "<h2>Mật khẩu mới của bạn là: $passrandom</h2><p>Vui lòng đổi mật khẩu sau khi đăng nhập.</p>";

        Mail::html($html, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Đặt lại mật khẩu');
        });

        return back()->with('message', 'Đã gửi mật khẩu mới. Bạn vui lòng kiểm tra email của bạn');
    }
}
