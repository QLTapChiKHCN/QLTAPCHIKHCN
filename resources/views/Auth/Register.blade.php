@extends('LayoutHome.master')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

<style>
  body {
    background-color: #f8f9fa;
    padding: 40px 0;
  }

  .form-container {
    max-width: 1000px;
    margin: 0 auto;
    background-color: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 40px;
  }

  .form-title {
    color: #0d6efd;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .section-title {
    color: #212529;
    font-size: 20px;
    font-weight: 600;
    margin: 25px 0 15px 0;
  }

  .form-control, .form-select {
    height: 48px;
    border-radius: 8px;
    border: 2px solid #dee2e6;
    padding: 10px 15px;
    font-size: 15px;
    transition: all 0.3s ease;
  }

  .form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
  }

  .input-group-text {
    background-color: transparent;
    border: none;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    z-index: 4;
  }

  .form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 8px;
  }

  .btn-primary {
    height: 48px;
    font-size: 16px;
    font-weight: 600;
    padding: 0 30px;
    border-radius: 8px;
    background-color: #0d6efd;
    border: none;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #0b5ed7;
    transform: translateY(-2px);
  }

  .btn-outline-primary {
    height: 48px;
    font-size: 16px;
    font-weight: 600;
    padding: 0 30px;
    border-radius: 8px;
    border: 2px solid #0d6efd;
    transition: all 0.3s ease;
  }

  .form-check {
    margin: 25px 0;
  }

  .form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  .divider {
    height: 1px;
    background-color: #dee2e6;
    margin: 30px 0;
  }
  .error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .success-modal .modal-content {
    border: none;
    border-radius: 15px;
  }

  .success-modal .modal-header {
    border: none;
    padding: 30px 30px 0;
  }

  .success-modal .modal-body {
    padding: 30px;
    text-align: center;
  }

  .success-modal .modal-footer {
    border: none;
    padding: 0 30px 30px;
    justify-content: center;
  }

  .success-icon {
    width: 80px;
    height: 80px;
    background: #198754;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
  }

  .error-icon {
    width: 80px;
    height: 80px;
    background: #dc3545;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
  }

  .invalid-feedback {
    display: block;
  }
  .error-message {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .is-invalid {
    border-color: #dc3545 !important;
  }

  .invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
  }
</style>


<div class="container">
    <div class="form-container">
      @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-title">
          <i class="bi bi-person-plus-fill"></i>
          Đăng ký tài khoản
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="section-title">
              <i class="bi bi-person-lines-fill me-2"></i>
              Thông tin cá nhân
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Họ và tên</label>
              <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror"
                     placeholder="Nhập họ và tên" value="{{ old('firstName') }}">
              <span class="input-group-text">
                <i class="bi bi-person-fill"></i>
              </span>
              @error('firstName')
              <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Chuyên ngành</label>
                <select name="chuyennganh" class="form-select ">
                  <option value="">Chọn chuyên ngành</option>
                  @foreach ($chuyennganh as $item)
                    <option value="{{ $item->MaChuyenNganh }} {{ old('chuyennganh') == $item->MaChuyenNganh ? 'selected' : '' }}" >
                      {{ $item->TenChuyenNganh }}
                    </option>
                  @endforeach
                </select>
                @error('chuyennganh')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Học vị</label>
                <select name="degree" class="form-select @error('degree') is-invalid @enderror">
                  <option value="">Chọn học vị</option>
                  @foreach ($hocvi as $item)
                    <option value="{{ $item->MaHocVi }}" {{ old('degree') == $item->MaHocVi ? 'selected' : '' }}>
                      {{ $item->TenHocVi }}
                    </option>
                  @endforeach
                </select>
                @error('degree')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Học hàm</label>
                <select name="rank" class="form-select @error('rank') is-invalid @enderror">
                  <option value="">Chọn học hàm</option>
                  @foreach ($hocham as $item)
                    <option value="{{ $item->MaHocHam }}" {{ old('rank') == $item->MaHocHam ? 'selected' : '' }}>
                      {{ $item->TenHocHam }}
                    </option>
                  @endforeach
                </select>
                @error('rank')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Giới tính</label>
                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                  <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                  <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                </select>
                @error('gender')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="section-title">
              <i class="bi bi-globe me-2"></i>
              Thông tin liên hệ
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Quốc gia</label>
                <select name="country" class="form-select @error('country') is-invalid @enderror">
                  <option value="">Chọn quốc gia</option>
                  @foreach ($quocgia as $item)
                    <option value="{{ $item->MaQG }}" {{ old('country') == $item->MaQG ? 'selected' : '' }}>
                      {{ $item->TenQG }}
                    </option>
                  @endforeach
                </select>
                @error('country')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Ngôn ngữ</label>
                <select name="language" class="form-select @error('language') is-invalid @enderror">
                  <option value="">Chọn ngôn ngữ</option>
                  @foreach ($ngonngu as $item)
                    <option value="{{ $item->MaNgonNgu }}" {{ old('language') == $item->MaNgonNgu ? 'selected' : '' }}>
                      {{ $item->TenNgonNgu }}
                    </option>
                  @endforeach
                </select>
                @error('language')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Đơn vị/Tổ chức</label>
              <select name="donvi" class="form-select">
                <option value="">Chọn đơn vị</option>
                @foreach ($donvi as $item)
                  <option value="{{ $item->MaDonVi }}" {{ old('donvi') == $item->MaDonVi ? 'selected' : '' }}>
                    {{ $item->TenDonVi }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Số điện thoại</label>
              <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                     placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
              <span class="input-group-text">
                <i class="bi bi-telephone-fill"></i>
              </span>
              @error('phone')
              <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Địa chỉ</label>
              <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                     placeholder="Nhập địa chỉ" value="{{ old('address') }}">
              <span class="input-group-text">
                <i class="bi bi-geo-alt-fill"></i>
              </span>
              @error('address')
              <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3 position-relative">
                <label class="form-label">Căn cước công dân</label>
                <input type="text" name="cccd" class="form-control @error('cccd') is-invalid @enderror"
                       placeholder="Nhập CCCD" value="{{ old('cccd') }}">
                <span class="input-group-text">
                  <i class="bi bi-geo-alt-fill"></i>
                </span>
                @error('cccd')
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle"></i>
                  {{ $message }}
                </div>
                @enderror
              </div>
          </div>
        </div>

        <div class="divider"></div>

        <div class="section-title">
          <i class="bi bi-shield-lock me-2"></i>
          Thông tin tài khoản
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="mb-3 position-relative">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                     placeholder="Nhập email" value="{{ old('email') }}">
              <span class="input-group-text">
                <i class="bi bi-envelope-fill"></i>
              </span>
              @error('email')
              <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Tên đăng nhập</label>
              <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                     placeholder="Nhập tên đăng nhập" value="{{ old('username') }}">
              <span class="input-group-text">
                <i class="bi bi-person-circle"></i>
              </span>
              @error('username')
              <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3 position-relative">
              <label class="form-label">Mật khẩu</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                     placeholder="Nhập mật khẩu">
              <span class="input-group-text">
                <i class="bi bi-lock-fill"></i>
              </span>
              @error('password')
              <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Xác nhận mật khẩu</label>
              <input type="password" name="confirmpassword" class="form-control @error('confirmpassword') is-invalid @enderror"
                     placeholder="Nhập lại mật khẩu">
              <span class="input-group-text">
                <i class="bi bi-lock-fill"></i>
              </span>
              @error('confirmpassword')
              <div class="invalid-feedback">
                <i class="bi bi-exclamation-circle"></i>
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>

        <div class="form-check">
          <input type="checkbox" class="form-check-input" required>
          <label class="form-check-label">Tôi đồng ý với các điều khoản và điều kiện</label>
        </div>

        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-person-plus-fill me-2"></i>
              Đăng ký
            </button>
          </div>
          <div class="col-md-6">
            <a href="{{ route('Login') }}" class="btn btn-outline-primary w-100">
              <i class="bi bi-box-arrow-in-right me-2"></i>
              Đăng nhập
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
<div class="modal fade success-modal" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="success-icon">
            <i class="bi bi-check-lg text-white" style="font-size: 40px;"></i>
          </div>
          <h4 class="mb-3">Đăng ký thành công!</h4>
          <p class="text-muted">Tài khoản của bạn đã được tạo thành công. Vui lòng đăng nhập để tiếp tục.</p>
        </div>
        <div class="modal-footer">
          <a href="{{ route('Login') }}" class="btn btn-primary">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Đăng nhập ngay
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Thất bại -->
  <div class="modal fade success-modal" id="errorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="error-icon">
            <i class="bi bi-x-lg text-white" style="font-size: 40px;"></i>
          </div>
          <h4 class="mb-3">Đăng ký thất bại!</h4>
          <p class="text-muted">Có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Hiện modal thành công/thất bại
    document.addEventListener('DOMContentLoaded', function() {
      @if(session('success'))
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
      @endif

      @if(session('error'))
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
      @endif
    });
  </script>
@endsection
