<!DOCTYPE html>
<html>
<head>
    <title>👤 Quản lý tài khoản - Shop Trái Cây</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h1 class="text-center mb-4">🍎 Shop Trái Cây Tươi</h1>

    <!-- Thanh menu -->
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('home') }}" class="btn btn-secondary me-2">🏠 Trang chủ</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Đăng xuất</button>
        </form>
    </div>

    <!-- Thông tin profile -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Cập nhật thông tin tài khoản
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label class="form-label">Tên</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div>
    </div>

    <!-- Đổi mật khẩu -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            Đổi mật khẩu
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control" required>
                    @error('current_password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu mới</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                    @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
            </form>
        </div>
    </div>

    <!-- Xóa tài khoản -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            Xóa tài khoản
        </div>
        <div class="card-body">
            <p class="text-danger">⚠️ Sau khi xóa, dữ liệu sẽ không thể khôi phục. Hãy chắc chắn trước khi thực hiện.</p>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="mb-3">
                    <label class="form-label">Nhập mật khẩu để xác nhận</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-danger">Xóa tài khoản</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
