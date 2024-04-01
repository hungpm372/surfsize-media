<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $appName;

    public function __construct()
    {
        $this->appName = config('app.name');
    }

    public function showFormLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $seo = [
            'title' => mb_convert_case("đăng nhập tài khoản | $this->appName", MB_CASE_TITLE, 'UTF-8'),
            'description' => "Đăng nhập Tài khoản $this->appName và tận hưởng ưu đãi độc quyền với giá cả hấp dẫn trên $this->appName!",
            'keywords' => $this->appName,
            'image' => null,
            'canonical' => null,
        ];

        return view('frontend.login', compact('seo'));
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended();
        }
        return back();
    }

    public function showFormRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $seo = [
            'title' => mb_convert_case("đăng ký ngay | $this->appName", MB_CASE_TITLE, 'UTF-8'),
            'description' => "Đăng ký tài khoản hôm nay và nhận ngay vô số deal và voucher độc quyền dành cho khách hàng mới trên $this->appName!",
            'keywords' => $this->appName,
            'image' => null,
            'canonical' => null,
        ];

        return view('frontend.register', compact('seo'));
    }

    public function register(UserRegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->flash('success', 'Tài khoản của bạn đã được tạo');

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function user()
    {
        return view('frontend.account');
    }
}
