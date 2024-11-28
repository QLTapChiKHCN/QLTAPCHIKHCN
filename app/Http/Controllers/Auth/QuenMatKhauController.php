<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Hash;

class QuenMatKhauController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    public function submitForgetPasswordForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:NguoiDung,Email'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Không tìm thấy email trong hệ thống'
        ]);


        $token = Str::random(64);


        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);


        $nguoiDung = NguoiDung::where('Email', $request->email)->first();

        Mail::send('emails.forget-password', ['token' => $token, 'nguoiDung' => $nguoiDung], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Đặt lại mật khẩu');
        });


        return back()->with('success', 'Chúng tôi đã gửi liên kết đặt lại mật khẩu tới email của bạn!');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:NguoiDung,Email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.exists' => 'Không tìm thấy email trong hệ thống',
            'password.required' => 'Vui lòng nhập mật khẩu mới',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu'
        ]);

        // Kiểm tra token
        $resetToken = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$resetToken) {
            return back()->withErrors(['email' => 'Liên kết đặt lại mật khẩu không hợp lệ']);
        }

        // Kiểm tra token hết hạn (30 phút)
        if (Carbon::parse($resetToken->created_at)->addMinutes(30)->isPast()) {
            DB::table('password_resets')->where(['email' => $request->email])->delete();
            return back()->withErrors(['email' => 'Liên kết đặt lại mật khẩu đã hết hạn']);
        }


        $nguoiDung = NguoiDung::where('Email', $request->email)->first();
        $nguoiDung->update([
            'MatKhau' => Hash::make($request->password)
        ]);


        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công');
    }
}
