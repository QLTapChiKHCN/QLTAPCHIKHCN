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

    @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.login-container {
    min-height: 100vh;
    background: rgba(102, 126, 234, 0.15);
    padding: 2rem 0;
    backdrop-filter: blur(10px);
    animation: fadeIn 1s ease-out;
}

.login-card {
    background: rgba(255, 255, 255, 0.85);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    max-width: 1000px;
    margin: auto;
    backdrop-filter: blur(5px);
    animation: slideIn 0.8s ease-out;
}

.login-header h1 {
    color: #333;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    animation: slideIn 0.8s ease-out 0.2s both;
}

.login-header p {
    color: #666;
    font-size: 1rem;
    animation: slideIn 0.8s ease-out 0.4s both;
}

.form-floating {
    margin-bottom: 1.5rem;
    animation: slideIn 0.8s ease-out 0.6s both;
}

.btn-login {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    border: none;
    padding: 0.8rem;
    font-weight: 600;
    transition: all 0.3s ease;
    animation: slideIn 0.8s ease-out 0.8s both;
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
    animation: slideIn 0.8s ease-out 1s both;
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
    position: relative;
    animation: fadeIn 1s ease-out;
}

.login-image img {
    max-width: 80%;
    height: auto;
    margin-bottom: 2rem;
    animation: pulse 2s infinite;
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
    animation: slideIn 0.8s ease-out 1.2s both;
}

.btn-register:hover {
    background: white;
    color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Add hover effect for form inputs */
.form-control:focus {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.25);
}

/* Add a subtle animation to the divider */
.divider::before,
.divider::after {
    animation: fadeIn 1s ease-out 1.4s both;
}

/* Add a subtle animation to the "Forgot password?" link */
a {
    transition: all 0.3s ease;
}

a:hover {
    transform: translateY(-2px);
}
</style>

<div class="login-container">


    <div class="container">
        <div class="row login-card">
            <!-- Left side - Image -->
            <div class="col-md-6 login-image">
                <div class="content-wrapper">
                    <img src="{{ asset('assets_home/image/logo.png') }}" alt="Login illustration" class="img-fluid">
                    <h2 class="mb-3 text-center align-items-center d-flex justify-content-center">Tạp Chí Khoa Học
                    <br>Công Nghệ</h2>
                    <p class="register-text">Chưa có tài khoản? Đăng ký ngay để trải nghiệm!</p>
                    <a href="{{ route('Register') }}" class="btn btn-register">
                        <i class="bi bi-person-plus-fill me-2"></i>Đăng Ký Ngay
                    </a>
                </div>

            </div>


            <div class="col-md-6 p-5">
                <div class="login-header">
                    <h1>Đăng Nhập</h1>
                    <p>Chào mừng bạn trở lại!</p>
                </div>
                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="emailInput" value="{{ old('username') }} " >
                        <label for="emailInput">Tên Đăng Nhập</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-floating mb-3 position-relative">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput">
                        <label for="passwordInput">Mật khẩu</label>
                        <span class="position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);">
                            <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                        </span>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>




                    @error('roles')
                        <div class="alert alert-danger mb-3">{{ $message }}</div>
                    @enderror


                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="remember_me" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                        </div>
                        <a href="{{ route('forget.password.get') }}" class="text-decoration-none">Quên mật khẩu?</a>
                    </div>


                    <button type="submit" class="btn btn-primary w-100 btn-login mb-3">
                        Đăng nhập
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);


            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    });
    </script>
@endsection
