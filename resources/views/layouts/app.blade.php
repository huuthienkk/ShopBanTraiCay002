<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Shop Trái Cây')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Layout toàn trang */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* luôn cao bằng màn hình */
            margin: 0;
        }
        main {
            flex: 1; /* chiếm khoảng trống còn lại */
        }
        footer {
            margin-top: auto; /* đẩy footer xuống cuối */
        }
    </style>
</head>
<body class="bg-light">

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">🍎 Shop Trái Cây</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">Giới thiệu</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Liên hệ</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/giohang') }}">🛒Giỏ hàng</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">👤 {{ Auth::user()->name }}</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ms-2">Đăng xuất</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="btn btn-light btn-sm ms-2" href="{{ route('login') }}">Đăng nhập</a></li>
                        <li class="nav-item"><a class="btn btn-warning btn-sm ms-2" href="{{ route('register') }}">Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- NỘI DUNG TRANG -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>🍎 Shop Trái Cây Tươi &copy; 2025 - All rights reserved</p>
    </footer>

</body>
</html>
