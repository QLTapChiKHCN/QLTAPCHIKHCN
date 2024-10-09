@extends('LayoutHome.master')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 40px 0;
    }

    .form-login {
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-bottom: 30px;
    }

    .section-title {
      color: #198754;
      margin-bottom: 25px;
      font-size: 24px;
    }

    .sub-section {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 25px;
    }

    .sub-section-title {
      color: #343a40;
      font-size: 18px;
      margin-bottom: 20px;
    }

    .form-control, .form-select {
      border-radius: 8px;
      padding: 10px 15px;
      border: 1px solid #dee2e6;
    }

    .form-control:focus, .form-select:focus {
      box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
      border-color: #198754;
    }

    .input-group-text {
      background-color: transparent;
      border: none;
      color: #6c757d;
    }

    .btn-register {
      background-color: #198754;
      color: white;
      padding: 12px 40px;
      border-radius: 8px;
      border: none;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-register:hover {
      background-color: #146c43;
      transform: translateY(-2px);
    }

    .btn-login {
      background-color: transparent;
      border: 2px solid #198754;
      color: #198754;
      padding: 10px 30px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background-color: #198754;
      color: white;
    }

    .form-check-input:checked {
      background-color: #198754;
      border-color: #198754;
    }
  </style>

<body>
    <section class="container-fluid">
        <form action="">
          <div class="container w-75 form-login">
            <h5 class="text-success fw-bold pt-4">
              <i class="bi bi-people-fill"></i> Đăng ký
            </h5>
            <hr />
            <div class="row">
              <div class="col-md-6">
                <h6 class="fw-bold">Thông tin cá nhân</h6>
                <hr />
                <div class="row">
                  <div class="mb-3 col-md-6 position-relative">
                    <label for="firstName" class="form-label"
                      >Họ và tên đệm</label
                    >
                    <div class="input-group">
                      <input type="text" style="width: 36px; border: none" />
                      <input
                        type="text"
                        name="firstName"
                        class="form-control"
                        placeholder="Họ và tên đệm"
                      />
                      <span class="input-group-text icon-close position-absolute">
                        <i class="bi bi-person-fill"></i>
                      </span>
                    </div>
                  </div>

                  <div class="mb-3 col-md-6 position-relative">
                    <label for="lastName" class="form-label">Tên</label>
                    <div class="input-group">
                      <input type="text" style="width: 36px; border: none" />
                      <input
                        type="text"
                        name="lastName"
                        class="form-control"
                        placeholder="Tên"
                      />
                      <span class="input-group-text icon-close position-absolute">
                        <i class="bi bi-person-fill"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6 position-relative">
                    <label for="degree" class="form-label">Học vị</label>
                    <div class="input-group">
                      <input type="text" style="width: 38px; border: none" />
                      <select name="degree" class="form-select">
                        <option value="Khong">Không</option>
                        <option value="CuNhan">Cử nhân</option>
                        <option value="ThacSi">Thạc sĩ</option>
                        <option value="TienSi">Tiến sĩ</option>
                        <option value="TSKH">TSKH</option>
                      </select>

                      <span class="input-group-text icon-close position-absolute">
                        <i class="bi bi-journal-bookmark-fill"></i>
                      </span>
                    </div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="rank" class="form-label">Học hàm</label>
                    <div class="input-group">
                      <input type="text" style="width: 38px; border: none" />
                      <select name="rank" class="form-select">
                        <option value="PhoGiaoSu">Phó giáo sư</option>
                        <option value="GiaoSu">Giáo sư</option>
                      </select>
                      <span class="input-group-text icon-close position-absolute">
                        <i class="bi bi-mortarboard-fill"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="gender" class="form-label">Giới tính</label>
                   <div class="input-group">
                    <input style="width: 38px; border: none" />
                    <select name="gender" class="form-select">
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                  </select>
                  <span class="input-group-text icon-close position-absolute">
                    <i class="bi bi-person-fill"></i>
                  </span>
                   </div>
                </div>

                <div class="mb-3 col-md-6">
                  <label for="language" class="form-label">Ngôn ngữ</label>
                  <div class="input-group">
                    <input style="width: 38px; border: none" />
                    <select name="language" class="form-select">
                      <option value="Vietnamese">Tiếng Việt</option>
                      <option value="English">English</option>
                      <option value="French">Français</option>
                      <!-- Thêm các tùy chọn ngôn ngữ khác nếu cần -->
                  </select>
                  <span class="input-group-text icon-close position-absolute">
                    <i class="bi bi-translate"></i>
                  </span>
                  </div>
              </div>

                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="country" class="form-label">Quốc gia</label>
                    <div class="input-group">
                      <input style="width: 38px; border: none" />
                      <select name="country" class="form-select">
                        <option value="Vietnam">Việt Nam</option>
                        <option value="UnitedStates">United States</option>
                        <option value="France">France</option>
                        <!-- Thêm các tùy chọn quốc gia khác nếu cần -->

                    </select>
                    <span class="input-group-text icon-close position-absolute">
                      <i class="bi bi-globe-americas"></i>
                    </span>
                    </div>
                </div>

                  <div class="mb-3 col-md-6 position-relative">
                    <label for="phone" class="form-label">Điện thoại</label>
                    <div class="input-group">
                      <input style="width: 38px; border: none" />
                      <input type="text" name="phone" class="form-control" placeholder="Số điện thoại"/>
                      <span class="input-group-text icon-close position-absolute">
                        <i class="bi bi-telephone-fill"></i>
                      </span>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Đơn vị/ Tổ chức</label>
                 <div class="input-group">
                  <input style="width: 38px; border: none" />
                  <input type="text" name="donvi" class="form-control" placeholder="Đơn vị/ Tổ chức"/>
                  <span class="input-group-text icon-close position-absolute">
                    <i class="bi bi-building-fill"></i>
                  </span>
                 </div>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Địa chỉ</label>
                    <div class="input-group">
                      <input style="width: 38px; border: none" />
                      <input type="text" name="address" class="form-control" placeholder="Địa chỉ"/>
                      <span class="input-group-text icon-close position-absolute">
                        <i class="bi bi-house-fill"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <hr />
                <h6 class="fw-bold mb-3">Thông tin tài khoản ngân hàng</h6>
                <hr />
                <div class="row">
                  <div class="mb-3 col-md-4">
                    <label for="accountNumber" class="form-label"
                      >Số tài khoản</label
                    >
                    <input
                      type="text"
                      name="accountNumber"
                      class="form-control"
                    />
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="accountHolder" class="form-label"
                      >Chủ tài khoản</label
                    >
                    <input
                      type="text"
                      name="accountHolder"
                      class="form-control"
                    />
                  </div>
                  <div class="mb-3 col-md-4">
                    <label for="bank" class="form-label">Ngân hàng</label>
                    <input type="text" name="bank" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <h6 class="fw-bold">Thông tin đăng nhập</h6>
                <hr />
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" name="email" class="form-control" />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Tên đăng nhập</label>
                  <input type="text" name="username" class="form-control" />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Mật khẩu</label>
                  <input type="password" name="password" class="form-control" />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Xác nhận mật khẩu</label>
                  <input
                    type="password"
                    name="confirmpassword"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <hr>
            <div class="form-check">
              <input type="checkbox" name="" id="" class="form-check-input">
              <label for="" class="form-check-label">Đồng ý với các điều khoản</label>
            </div>
           <div class="btn-signup text-center">
            <button type="submit" class="btn btn-danger mt-2 mb-3 border-danger w-50"> <span class="text-info">Đăng ký <i class="bi bi-box-arrow-right text-info"></i></span></button>
           </div>
           <div class="btn-signin text-center">
            <button type="submit" class="btn btn-danger mt-2 mb-3 border-danger w-100"><span class="text-warning"><i class="bi bi-box-arrow-left text-warning"></i> <a href="#!/login" class="text-decoration-none text-warning">Đăng nhập</a></button></span>
           </div>
          </div>
        </form>
      </section>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>


@endsection
