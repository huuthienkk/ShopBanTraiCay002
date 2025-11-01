@extends('layouts.app')

@section('title', 'Trang chủ - Shop Trái Cây')

@section('content')
    <!-- Hiển thị thông tin user với ảnh đại diện -->
    @auth
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex align-items-center">
            <img src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : 'https://via.placeholder.com/80' }}" 
                 alt="Ảnh đại diện" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
            <div>
                <h4 class="mb-1">Xin chào, {{ auth()->user()->name }}! 👋</h4>
                <p class="text-muted mb-0">Chào mừng bạn trở lại với Shop Trái Cây Tươi</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm mt-2">Cập nhật hồ sơ</a>
            </div>
        </div>
    </div>
    @endauth

    <!-- Hero Banner -->
    <div class="p-5 mb-4 bg-success text-white rounded-3 text-center shadow-sm">
        <h1 class="display-4">🍎 Shop Trái Cây Tươi</h1>
        <p class="lead">Nơi bạn tìm thấy những loại trái cây sạch, tươi ngon và tốt cho sức khỏe mỗi ngày.</p>
        <a href="{{ url('/products') }}" class="btn btn-light btn-lg">Khám phá ngay</a>
    </div>

    <!-- Danh mục nổi bật -->
    <h2 class="text-center mb-4">Danh mục nổi bật</h2>
    <div class="row text-center mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm">
                
                <div class="card-body">
                    <h5>Táo</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                
                <div class="card-body">
                    <h5>Cam</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                
                <div class="card-body">
                    <h5>Nho</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                
                <div class="card-body">
                    <h5>Xoài</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm nổi bật -->
    <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
    <div class="row mb-5">
        @foreach ([
            ['id'=>1, 'name'=>'Táo Mỹ', 'price'=>50000, 'img'=>asset('images/taomy.png')],
            ['id'=>2, 'name'=>'Cam Sành', 'price'=>40000, 'img'=>asset('images/cam.jpg')],
            ['id'=>3, 'name'=>'Nho Ninh Thuận', 'price'=>120000, 'img'=>asset('images/nho.jpg')],
            ['id'=>4, 'name'=>'Xoài Cát', 'price'=>70000, 'img'=>asset('images/xoai.webp')],
        ] as $fruit)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ $fruit['img'] }}" class="card-img-top" alt="{{ $fruit['name'] }}">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title">{{ $fruit['name'] }}</h5>
                    <p class="card-text">{{ number_format($fruit['price']) }} đ / kg</p>
                    <form action="{{ route('cart.add', $fruit['id']) }}" method="POST" class="mt-auto">
                        @csrf
                        <input type="hidden" name="name" value="{{ $fruit['name'] }}">
                        <input type="hidden" name="price" value="{{ $fruit['price'] }}">
                        <button type="submit" class="btn btn-success">Thêm vào giỏ</button>
                    </form>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <!-- Ưu điểm -->
    <h2 class="text-center mb-4">Tại sao chọn Shop Trái Cây? 🍊</h2>
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <i class="bi bi-truck display-4 text-success"></i>
            <h5>Giao hàng nhanh</h5>
            <p>Nhận hàng trong vòng 2 giờ tại nội thành.</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-bag-check display-4 text-success"></i>
            <h5>Sản phẩm chất lượng</h5>
            <p>Trái cây được tuyển chọn kỹ lưỡng, đảm bảo tươi ngon.</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-heart display-4 text-success"></i>
            <h5>An toàn sức khỏe</h5>
            <p>Không chất bảo quản, đảm bảo an toàn cho gia đình bạn.</p>
        </div>
    </div>

    <!-- Feedback khách hàng -->
    <h2 class="text-center mb-4">Khách hàng nói gì? 💬</h2>
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <p>"Trái cây rất tươi, giao hàng nhanh. Tôi sẽ tiếp tục ủng hộ!"</p>
                <h6 class="text-end">- Anh Tuấn, Hà Nội</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <p>"Nho ngọt và ngon, ăn y như nho mới hái!"</p>
                <h6 class="text-end">- Chị Lan, Đà Nẵng</h6>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <p>"Rất thích dịch vụ chăm sóc khách hàng, rất tận tâm."</p>
                <h6 class="text-end">- Minh Hoàng, Sài Gòn</h6>
            </div>
        </div>
    </div>

    <!-- CTA đăng ký nhận tin -->
    <div class="p-5 bg-light rounded shadow-sm text-center">
        <h3>Đăng ký nhận bản tin khuyến mãi 🎉</h3>
        <p>Nhận thông tin về sản phẩm mới và các chương trình giảm giá hấp dẫn.</p>
        <form class="d-flex justify-content-center">
            <input type="email" class="form-control w-25 me-2" placeholder="Nhập email của bạn">
            <button class="btn btn-success">Đăng ký</button>
        </form>
    </div>
@endsection
