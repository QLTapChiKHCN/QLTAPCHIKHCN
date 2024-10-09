@extends('LayoutHome.master')
@section('content')
<style>
    .login-container {
        min-height: 100vh;
        /* Thay đổi background thành màu xanh dương trong suốt */
        background: rgba(102, 126, 234, 0.15);
        padding: 2rem 0;
        backdrop-filter: blur(10px); /* Thêm hiệu ứng blur cho nền */
    }

    .login-card {
        background: rgba(255, 255, 255, 0.85); /* Làm trong suốt hơn một chút */
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 1000px;
        margin: auto;
        backdrop-filter: blur(5px); /* Thêm hiệu ứng blur cho card */
    }

    .login-header {
        text-align: center;
        padding: 2rem 0;
    }

    .login-header h1 {
        color: #333;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .login-header p {
        color: #666;
        font-size: 1rem;
    }

    .form-floating {
        margin-bottom: 1.5rem;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.9); /* Input trong suốt một chút */
    }

    .form-control:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 0 0.25rem rgba(74, 144, 226, 0.25);
        background: rgba(255, 255, 255, 0.95);
    }

    .btn-login {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        border: none;
        padding: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, rgba(102, 126, 234, 1) 0%, rgba(118, 75, 162, 1) 100%);
    }

    .social-login {
        border: 1px solid rgba(221, 221, 221, 0.5);
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
    }

    .social-login:hover {
        background: rgba(248, 249, 250, 0.95);
        transform: translateY(-2px);
    }

    .login-image {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
        padding: 3rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .login-image img {
        max-width: 80%;
        height: auto;
        margin-bottom: 2rem;
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 1.5rem 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid rgba(221, 221, 221, 0.8);
    }

    .divider span {
        padding: 0 1rem;
        color: #666;
        font-size: 0.9rem;
    }

    /* Thêm hiệu ứng hover cho links */
    a {
        color: #4a90e2;
        transition: all 0.3s ease;
    }

    a:hover {
        color: #357abd;
        text-decoration: none;
    }
    .btn-register {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid white;
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 1rem;
        text-decoration: none;
    }

    .btn-register:hover {
        background: white;
        color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .login-image {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
        padding: 3rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        position: relative; /* Thêm position relative */
    }

    .login-image .content-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 1rem;
    }

    .register-text {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.9);
        margin-top: 0.5rem;
        text-align: center;
    }
</style>

<div class="login-container">
    <div class="container">
        <div class="row login-card">
            <!-- Left side - Image -->
            <div class="col-md-6 login-image">
                <div class="content-wrapper">
                    <img src="{{ asset('assets_home/image/logo.png') }}" alt="Login illustration" class="img-fluid">
                    <h2 class="mb-3">Tạp Chí Khoa Học Công Nghệ</h2>
                    <p class="register-text">Chưa có tài khoản? Đăng ký ngay để trải nghiệm!</p>
                    <a href="{{ route('Register') }}" class="btn btn-register">
                        <i class="bi bi-person-plus-fill me-2"></i>Đăng Ký Ngay
                    </a>
                </div>

            </div>

            <!-- Right side - Login form -->
            <div class="col-md-6 p-5">
                <div class="login-header">
                    <h1>Đăng Nhập</h1>
                    <p>Chào mừng bạn trở lại!</p>
                </div>

                <form>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="emailInput" placeholder="name@example.com">
                        <label for="emailInput">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="passwordInput" placeholder="Password">
                        <label for="passwordInput">Mật khẩu</label>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                        </div>
                        <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login mb-3">
                        Đăng nhập
                    </button>

                    <div class="divider">
                        <span>hoặc</span>
                    </div>

                    <button type="button" class="btn w-100 social-login mb-3">
                        <img src="{{ asset('assets_home/image/google.png') }}" alt="Google" style="width: 20px; margin-right: 10px;">
                        Đăng nhập với Google
                    </button>

                    <div class="text-center">
                        <p class="mb-0">Chưa có tài khoản?
                            <a href="#!/signup" class="text-decoration-none">Đăng ký ngay</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
