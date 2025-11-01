<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - Shop Trái Cây</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="/">🍎 Shop Trái Cây</a>
            <div class="d-flex">
                <a href="/" class="btn btn-light me-2">Trang chủ</a>
                <a href="/giohang" class="btn btn-warning me-2">🛒 Giỏ hàng</a>
                @auth
                    <a href="{{ route('profile.edit') }}" class="btn btn-light me-2">👤 Profile</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Đăng xuất</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light me-2">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-warning">Đăng ký</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Nội dung chính -->
    <main class="container my-4 flex-grow-1">
        <h2 class="mb-4">🛒 Giỏ hàng của bạn</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(empty($cart))
            <div class="alert alert-info">Giỏ hàng trống. Hãy thêm sản phẩm để mua sắm nhé!</div>
        @else
            <table class="table table-bordered bg-white">
                <thead class="table-success">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ number_format($item['price']) }} đ</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'] * $item['quantity']) }} đ</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="text-end">Tổng: <b>{{ number_format($total) }} đ</b></h4>

            <form action="{{ route('cart.checkout') }}" method="POST" class="text-end">
                @csrf
                <button type="submit" class="btn btn-success">Thanh toán</button>
            </form>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">© 2025
