<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ChuyenNganh;
use App\Models\DonVi;
use App\Models\HocHam;
use App\Models\HocVi;
use App\Models\NgonNgu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\NguoiDungVaiTro;
use App\Models\QuocGia;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function Showlogin()
    {
        return view('Auth.Login');
    }

    public function ShowRegister()
    {
        $ngonngu=NgonNgu::all();
        $hocvi=HocVi::all();
        $hocham=HocHam::all();
        $quocgia=QuocGia::all();
        $donvi=DonVi::all();
        $chuyennganh=ChuyenNganh::all();
        return view('Auth.Register',compact('chuyennganh','donvi','ngonngu','hocvi','hocham','quocgia'));
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


    public function Register(Request $request)
{
    // Validate đầu vào
    $request->validate([
        'firstName' => 'required|string|max:255',
        'degree' => 'required|exists:HocVi,MaHocVi',
        'chuyennganh'=>'required|exists:ChuyenNganh,MaChuyenNganh',
        'rank' => 'nullable|exists:HocHam,MaHocHam',
        'gender' => 'required|in:Nam,Nữ',
        'language' => 'required|exists:NgonNgu,MaNgonNgu',
        'country' => 'required|exists:QuocGia,MaQG',
        'phone' => 'required|string|max:10',
        'address' => 'required|string|max:255',
        'email' => 'required|email',
        'username' => 'required|string|min:6',
        'password' => 'required|string|min:6',
        'confirmpassword' => 'required|same:password',
        'cccd' => 'required|string|size:12|regex:/^[0-9]+$/',
    ], [
        'firstName.required' => 'Họ và tên không được để trống',
        'chuyennganh.required'=>'Vui lòng chọn chuyên ngành',
        'gender.required' => 'Vui lòng chọn giới tính',
        'gender.in' => 'Giới tính không hợp lệ',
        'language.required' => 'Vui lòng chọn ngôn ngữ',
        'language.exists' => 'Ngôn ngữ không hợp lệ',
        'country.required' => 'Vui lòng chọn quốc gia',
        'country.exists' => 'Quốc gia không hợp lệ',
        'phone.required' => 'Số điện thoại không được để trống',
        'phone.max' => 'Số điện thoại không quá 10 ký tự',
        'address.required' => 'Địa chỉ không được để trống',
        'email.required' => 'Email không được để trống',
        'email.email' => 'Email không đúng định dạng',
        'username.required' => 'Tên đăng nhập không được để trống',
        'username.min' => 'Tên đăng nhập phải có ít nhất 6 ký tự',
        'password.required' => 'Mật khẩu không được để trống',
        'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        'confirmpassword.required' => 'Vui lòng xác nhận mật khẩu',
        'confirmpassword.same' => 'Xác nhận mật khẩu không khớp',
        'cccd.required' => 'CCCD không được để trống',
        'cccd.size' => 'CCCD phải có đúng 12 số',
        'cccd.regex' => 'CCCD chỉ được chứa số',
    ]);

    try {
        // Kiểm tra email đã tồn tại chưa
        $existingUser = NguoiDung::where('Email', $request->email)->first();

        if ($existingUser) {
            // Nếu email tồn tại và đã có tên đăng nhập và mật khẩu
            if ($existingUser->TenDangNhap && $existingUser->MatKhau) {
                return back()->with('error', 'Tài khoản đã tồn tại trong hệ thống!')->withInput();
            }
            // Kiểm tra xem tên đăng nhập mới có bị trùng không
            $usernameExists = NguoiDung::where('TenDangNhap', $request->username)
                                     ->where('MaNguoiDung', '!=', $existingUser->MaNguoiDung)
                                     ->exists();
            if ($usernameExists) {
                return back()->withErrors(['username' => 'Tên đăng nhập đã tồn tại'])->withInput();
            }
            $existingUser->HoTen = $request->firstName;
            $existingUser->MaChuyenNganh = $request->chuyennganh;
            $existingUser->MaHocVi = $request->degree;
            $existingUser->MaHocHam = $request->rank ?? null;
            $existingUser->GioiTinh = $request->gender;
            $existingUser->MaQG = $request->country;
            $existingUser->SoDienThoai = $request->phone;
            $existingUser->MaDonVi = $request->donvi;
            $existingUser->DiaChi = $request->address;
            $existingUser->TenDangNhap = $request->username;
            $existingUser->MatKhau = Hash::make($request->password);
            $existingUser->CCCD = $request->cccd;

            $existingUser->save();


            NguoiDungVaiTro::create([
                'MaNguoiDung' => $existingUser->MaNguoiDung,
                'MaVaiTro' => 'VT03'
            ]);

            Auth::login($existingUser);
            return redirect()->route('Trangchu')->with('success', 'Cập nhật tài khoản thành công!');
        }
        else
        {

            // Tạo người dùng mới nếu email chưa tồn tại
            $maNguoiDung = $this->generateMaNguoiDung();

            if (NguoiDung::where('TenDangNhap', $request->username)->exists()) {
                return back()->withErrors(['username' => 'Tên đăng nhập đã tồn tại'])->withInput();
            }

            $nguoiDung = new NguoiDung();
            $nguoiDung->MaNguoiDung = $maNguoiDung;
            $nguoiDung->HoTen = $request->firstName;
            $nguoiDung->MaChuyenNganh = $request->chuyennganh;
            $nguoiDung->MaHocVi = $request->degree;
            $nguoiDung->MaHocHam = $request->rank ?? null;
            $nguoiDung->GioiTinh = $request->gender;
            $nguoiDung->MaQG = $request->country;
            $nguoiDung->SoDienThoai = $request->phone;
            $nguoiDung->MaDonVi = $request->donvi;
            $nguoiDung->DiaChi = $request->address;
            $nguoiDung->Email = $request->email;
            $nguoiDung->TenDangNhap = $request->username;
            $nguoiDung->MatKhau = Hash::make($request->password);
            $nguoiDung->CCCD = $request->cccd;
            $nguoiDung->save();

            NguoiDungVaiTro::create([
                'MaNguoiDung' => $maNguoiDung,
                'MaVaiTro' => 'VT03'
            ]);

            Auth::login($nguoiDung);
            return redirect()->route('Trangchu')->with('success', 'Đăng ký tài khoản thành công!');
    }

    } catch (\Exception $e) {
        \Log::error('Lỗi đăng ký: ' . $e->getMessage());
        return back()->with('error', 'Có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại!')->withInput();
    }
}
    private function generateMaNguoiDung()
        {
            $prefix = 'ND';
            $lastUser = NguoiDung::orderBy('MaNguoiDung', 'desc')->first();

            if ($lastUser) {
                $lastNumber = intval(substr($lastUser->MaNguoiDung, 2));
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            return $prefix . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
        }

}
