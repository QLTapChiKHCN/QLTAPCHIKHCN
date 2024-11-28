<h1>Đặt Lại Mật Khẩu</h1>
<p>Xin chào {{ $nguoiDung->HoTen }},</p>
<p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấp vào liên kết dưới đây để đặt lại:</p>
<a href="{{ route('reset.password.get', $token) }}">Đặt Lại Mật Khẩu</a>
<p>Liên kết này sẽ hết hạn sau 30 phút.</p>
<p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
