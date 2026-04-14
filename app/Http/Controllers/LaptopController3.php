<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaptopController3 extends Controller
{
    public function detail($id)
    {
        $laptop = DB::table('san_pham')->where('id', $id)->first();
        if (!$laptop) {
            return redirect('/')->with('error', 'Không tìm thấy sản phẩm!');
        }
        return view('laptop.detail', compact('laptop'), ['title' => $laptop->tieu_de]);
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity ?? 1;

        $laptop = DB::table('san_pham')->where('id', $id)->first();

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "name" => $laptop->tieu_de,
                "quantity" => $quantity,
                "price" => $laptop->gia,
                "image" => $laptop->hinh_anh
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function viewCart()
    {

        return view('laptop.cart', ['title' => 'Giỏ hàng']);
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm!');
    }

    // CÂU 4: Xử lý đặt hàng
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Giỏ hàng trống!');
        }
        $userId = auth()->id() ?? null;

        DB::beginTransaction();

        try {
            $maDonHang = DB::table('don_hang')->insertGetId([
                'ngay_dat_hang' => now(),
                'tinh_trang' => 1,  
                'hinh_thuc_thanh_toan' => 1,  
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Thêm chi tiết đơn hàng
            foreach ($cart as $id => $item) {
                DB::table('chi_tiet_don_hang')->insert([
                    'ma_don_hang' => $maDonHang,
                    'laptop_id' => $id,
                    'so_luong' => $item['quantity'],
                    'don_gia' => $item['price'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Xóa giỏ hàng
            session()->forget('cart');

            DB::commit();
            return redirect('/')->with('success', 'Đặt hàng thành công! Mã đơn: #' . $maDonHang);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/')->with('error', 'Đặt hàng thất bại: ' . $e->getMessage());
        }
    }
}