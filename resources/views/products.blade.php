@extends('layouts.app')

@section('content')
<h2 class="mb-4">Danh sách sản phẩm</h2>
<div class="row">

    @foreach ([
        ['id'=>1, 'name'=>'Cam Sành', 'price'=>40000, 'img'=>'images/cam.jpg'],
        ['id'=>2, 'name'=>'Táo Mỹ', 'price'=>50000, 'img'=>'images/taomy.png'],
        ['id'=>3, 'name'=>'Nho Ninh Thuận', 'price'=>120000, 'img'=>'images/nho.jpg'],
        ['id'=>4, 'name'=>'Xoài Cát', 'price'=>70000, 'img'=>'images/xoai.webp'],
        ['id'=>5, 'name'=>'Chuối Laba', 'price'=>30000, 'img'=>'images/chuoi.webp'],
    ] as $product)
    <div class="col-md-3 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="img-container">
                <img src="{{ asset($product['img']) }}" class="card-img-top" alt="{{ $product['name'] }}">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title">{{ $product['name'] }}</h5>
                <p class="card-text">{{ number_format($product['price']) }} đ / kg</p>
                <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="{{ $product['name'] }}">
                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                    <button type="submit" class="btn btn-success">Thêm vào giỏ</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
