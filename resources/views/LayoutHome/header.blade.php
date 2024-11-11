
  <!-- Banner Header -->
  <section class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mt-2">
          <a href="#">
            <img
              src="https://huit.edu.vn/Images/Documents/N00CT/logo-huit-web-chinh-moi-mau-xanh-02.svg?h=80"
              class="img-fluid"
              style="width: 350px"
          /></a>
        </div>
        <div class="col-md-5 mt-4 text-center header-color">
          <h3><b>TẠP CHÍ KHOA HỌC CÔNG NGHỆ HUIT</b></h3>
          <h5><b>HUIT JOURNAL OF SCIENCE AND TECHNOLOGY</b></h5>
        </div>
        <div
          class="col-md-4 mt-5 header-color"
          style="position: relative; left: 20px"
        >

        </div>
      </div>
    </div>
  </section>
<!-- Main Navigation -->
<nav class="navbar navbar-expand-lg main-nav">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('Trangchu') }}">
                        <i class="bi bi-house-fill"></i>Trang chủ
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-newspaper"></i>Giới thiệu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-telephone-fill"></i>Liên hệ
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('quanlibaiviet') }}">
                        <i class="bi bi-journals"></i>Quản lí bài viết
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ShowPost') }}">
                        <i class="bi bi-journals"></i>Gửi bài Online
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>
                        @if (Auth::check())
                            {{ Auth::user()->HoTen }}
                        @else
                            Tài khoản
                        @endif
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if (Auth::check())
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>

                        @php
                            $laPhanBien = Auth::user()->vaiTros()->where('NguoiDung_VaiTro.MaVaiTro', 'VT04')->exists();
                        @endphp

                        @if ($laPhanBien)
                            <li><a class="dropdown-item" href="{{ route('PhanBien') }}">Phản biện bài viết</a></li>
                        @endif
                    @else
                        <li><a class="dropdown-item" href="{{ route('Login') }}">Đăng nhập</a></li>
                    @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
