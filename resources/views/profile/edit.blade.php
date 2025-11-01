<!DOCTYPE html>
<html>
<head>
    <title>👤 Quản lý tài khoản - Shop Trái Cây</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
            margin-bottom: 15px;
        }
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .file-input-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        .avatar-section {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }
    </style>
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

    <!-- Hiển thị ảnh đại diện hiện tại -->
    <div class="avatar-section">
        <img id="avatarPreview" src="{{ auth()->user()->avatar ? Storage::url(auth()->user()->avatar) : 'https://via.placeholder.com/120' }}" 
             alt="Ảnh đại diện" class="avatar-preview">
        <p class="text-muted">Ảnh đại diện hiện tại</p>
    </div>

    <!-- Thông tin profile -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Cập nhật thông tin tài khoản
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <!-- Phần upload ảnh đại diện -->
                <div class="mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <div class="file-input-wrapper">
                        <button type="button" class="btn btn-outline-primary btn-sm">Chọn ảnh mới</button>
                        <input type="file" id="avatar" name="avatar" accept="image/*">
                    </div>
                    <div class="form-text">Chọn ảnh đại diện mới (tối đa 2MB)</div>
                    @error('avatar') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

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

<script>
    // Preview ảnh khi chọn file mới
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Kiểm tra kích thước file (tối đa 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Kích thước ảnh không được vượt quá 2MB');
                this.value = '';
                return;
            }
            
            // Kiểm tra loại file
            if (!file.type.match('image.*')) {
                alert('Vui lòng chọn file ảnh');
                this.value = '';
                return;
            }
            
            // Hiển thị preview ảnh
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</body>
</html>