<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function Showlogin()
    {
        return view('Auth.Login');
    }

    public function ShowRegister()
    {
        return view('Auth.Register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('Login')->with('success','Đăng xuất thành công') ;
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Tên đăng nhập không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        $nguoiDung = NguoiDung::where('TenDangNhap', $request->username)->first();
        if (!$nguoiDung) {
            return back()->withErrors([
                'username' => 'Tên đăng nhập không chính xác',
            ])->withInput();
        }

        if (!Hash::check($request->password, $nguoiDung->MatKhau)) {
            return back()->withErrors([
                'password' => 'Mật khẩu không chính xác',
            ])->withInput();
        }


        $laTacGia = $nguoiDung->vaiTros()
            ->where('NguoiDung_VaiTro.MaVaiTro', 'VT03')
            ->exists();

        if ($laTacGia) {
            Auth::login($nguoiDung);
            return redirect()->route('Trangchu')->with('success', 'Đăng nhập thành công');
        } else {
            return back()->withErrors(['roles' => 'Bạn không có quyền truy cập vào hệ thống này']);
        }
    }


}
