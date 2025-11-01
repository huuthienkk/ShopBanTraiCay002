<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Shop Trái Cây</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
            margin-bottom: 10px;
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
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center mb-4">Đăng ký</h2>

    {{-- Hiển thị lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        
        <!-- Phần tải ảnh đại diện -->
        <div class="avatar-section">
            <img id="avatarPreview" src="https://via.placeholder.com/100" alt="Ảnh đại diện" class="avatar-preview">
            <div class="file-input-wrapper">
                <button type="button" class="btn btn-outline-secondary btn-sm">Chọn ảnh đại diện</button>
                <input type="file" id="avatar" name="avatar" accept="image/*">
            </div>
            <div class="form-text">Chọn ảnh đại diện (tối đa 2MB)</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Đăng ký</button>
        <p class="text-center mt-3">Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
    </form>
</div>

<script>
    document.getElementById('avatar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Kiểm tra kích thước file (tối đa 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Kích thước ảnh không được vượt quá 2MB');
                this.value = ''; // Xóa file đã chọn
                return;
            }
            
            // Kiểm tra loại file
            if (!file.type.match('image.*')) {
                alert('Vui lòng chọn file ảnh');
                this.value = ''; // Xóa file đã chọn
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