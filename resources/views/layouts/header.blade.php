<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">🍎 Shop Trái Cây</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">Giới thiệu</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Liên hệ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/giohang') }}">🛒Giỏ hàng</a></li>
            </ul>

            <div class="d-flex">
                @auth
                    <a href="{{ route('profile.edit') }}" class="btn btn-light me-2">👤 Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-warning">Đăng ký</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
