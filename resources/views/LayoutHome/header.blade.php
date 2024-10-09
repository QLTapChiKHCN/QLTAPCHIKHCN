
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
        <div class="col-md-4 mt-4 text-center header-color">
          <h3><b>TẠP CHÍ CÔNG NGHỆ HUIT</b></h3>
          <h5><b>HUIT TECHNOLOGY MAGAZINE</b></h5>
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
                    <a class="nav-link" href="#!/home">
                        <i class="bi bi-house-fill"></i>Trang chủ
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-justify"></i>Danh mục
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item-container">
                            <a href="#!/quanlykinhke" class="dropdown-item">Quản lý kinh tế</a>
                            <a href="#" class="dropdown-item">Khoa học - Công nghệ</a>
                            <a href="#" class="dropdown-item">Google Scholar</a>
                            <a href="#" class="dropdown-item">TCKH Việt Nam trực tuyến</a>
                            <a href="#" class="dropdown-item">HĐ Chức danh Giáo sư</a>
                            <a href="#" class="dropdown-item">Trường ĐH Công Thương</a>
                        </li>
                    </ul>
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ShowPost') }}">
                        <i class="bi bi-journals"></i>Gửi bài Online
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-fill"></i>Tài khoản
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('Login') }}">Đăng nhập</a></li>
                        <li><a class="dropdown-item" href="#!/logout">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
