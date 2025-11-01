@extends('layouts.app')

@section('content')
<h2>Liên hệ với chúng tôi</h2>
<form>
    <div class="mb-3">
        <label class="form-label">Họ và tên</label>
        <input type="text" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nội dung</label>
        <textarea class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Gửi liên hệ</button>
</form>
@endsection
