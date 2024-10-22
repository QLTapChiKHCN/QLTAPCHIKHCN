<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN</title>
    <link rel="stylesheet" href="{{ asset('assets_home/bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" />
    <link rel="stylesheet" href="{{ asset('assets_home/css/index.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets_home/bootstrap-icons-1.11.2/font/bootstrap-icons.css') }}" />
    <script src="{{ asset('assets_home/bootstrap-5.3.2-dist/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_home/js/angular.min.js') }}"></script>
    <script src="https://code.angularjs.org/1.8.2/angular-route.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/d65420k7p618ngilkrjmefv3dayjqvwk61qiigco4l3mth6f/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.0/js/froala_editor.pkgd.min.js"></script>
    <style>
        :root {
            --primary-color: #1a73e8;
            --secondary-color: #174ea6;
            --background-light: #f8f9fa;
            --text-dark: #202124;
            --text-light: #5f6368;
            --header-height: 80px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            margin: 0;
            padding: 0;
        }

        /* Header Styles */
        .top-header {
            background: linear-gradient(to right, #fff, #f8f9fa);
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .brand-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 1rem;
            color: var(--text-light);
            margin-top: 5px;
        }

        /* Navigation Styles */
        .main-nav {
            background: var(--primary-color);
            padding: 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-link {
            color: white !important;
            padding: 1rem 1.2rem !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .nav-link i {
            margin-right: 6px;
            font-size: 1.1rem;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 8px 0;
        }

        .dropdown-item {
            padding: 8px 20px;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(26,115,232,0.1);
            color: var(--primary-color);
        }

        .list-group-item {
            border: none;
            padding: 12px 20px;
            transition: all 0.2s ease;
        }

        .list-group-item:hover {
            background-color: rgba(26,115,232,0.1);
            color: var(--primary-color);
        }

        footer {
            background-color: var(--primary-color);
            color: white;
            padding: 40px 0;
            margin-top: 40px;
        }

        footer span {
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        footer .social-links a {
            transition: opacity 0.3s ease;
        }

        footer .social-links a:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            footer .col-md-4:not(:last-child) {
                border-bottom: 1px solid rgba(255,255,255,0.1);
                padding-bottom: 20px;
                margin-bottom: 20px;
            }
        }
    </style>
    @stack('css')
</head>
<body>
    @include('LayoutHome.PBheader')
    @yield('content')
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('assets_home/image/logo.png') }}" class="img-fluid mb-3" style="max-width: 150px" alt="Footer Logo">
                    <div>
                        <span class="d-block mb-2"><strong>TẠP CHÍ CÔNG NGHỆ HUIT</strong></span>
                        <span class="d-block">Tại: Trường Đại Học Công Thương</span>
                        <span class="d-block">140 Đ. Lê Trọng Tấn, Tây Thạnh, Tân Phú, TP.HCM</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <span class="d-block mb-2"><strong>Thông tin liên hệ</strong></span>
                    <span class="d-block">Thành viên:</span>
                    <span class="d-block">Điện thoại: 0987654321</span>
                    <span class="d-block">Email: ducdb@gmail.com</span>
                </div>
                <div class="col-md-4">
                    <span class="d-block mb-2"><strong>Theo dõi chúng tôi</strong></span>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets_home/js/index.js') }}"></script>
</body>
</html>
