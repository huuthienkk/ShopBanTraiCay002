<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('giohang', compact('cart', 'total'));
    }

    // Thêm sản phẩm vào giỏ
    public function add(Request $request, $id)
    {
        $product = [
            'id' => $id,
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => 1,
        ];

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = $product;
        }

        Session::put('cart', $cart);

        return redirect()->route('giohang')->with('success', 'Đã thêm vào giỏ hàng!');
    }

    // Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->route('giohang')->with('success', 'Đã xóa sản phẩm!');
    }

    // Thanh toán
    public function checkout()
    {
        Session::forget('cart');
        return redirect()->route('giohang')->with('success', 'Thanh toán thành công!');
    }
}
