<?php

namespace App\Http\Controllers;

use App\Notifications\TestSendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaptopController3 extends Controller
{
    public function chitiet($id)
    {
        $data = DB::table('san_pham')->where('id', $id)->first();

        if (!$data) {
            return redirect('/')->with('error', 'Không tìm thấy sản phẩm!');
        }

        return view('laptop.detail', compact('data'));
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
            'num' => ['required', 'numeric', 'min:1'],
        ]);

        $id = (int) $request->id;
        $num = (int) $request->num;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id] += $num;
        } else {
            $cart[$id] = $num;
        }

        session()->put('cart', $cart);

        return response()->json(count($cart));
    }

    public function order()
    {
        $cart = session()->get('cart', []);
        $data = collect();
        $quantity = [];

        if (!empty($cart)) {
            $ids = array_keys($cart);
            foreach ($cart as $id => $value) {
                $quantity[$id] = (int) $value;
            }
            $data = DB::table('san_pham')->whereIn('id', $ids)->get();
        }

        return view('laptop.cart', compact('quantity', 'data'));
    }

    public function cartdelete(Request $request)
    {
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        $id = (int) $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart');
    }

    public function ordercreate(Request $request)
    {
        $request->validate([
            'hinh_thuc_thanh_toan' => ['required', 'numeric'],
        ]);

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Giỏ hàng trống.');
        }

        $mailData = [];

        DB::transaction(function () use ($request, $cart, &$mailData) {
            $id_don_hang = DB::table('don_hang')->insertGetId([
                'ngay_dat_hang' => now(),
                'tinh_trang' => 1,
                'hinh_thuc_thanh_toan' => $request->hinh_thuc_thanh_toan,
                'user_id' => Auth::id(),
            ]);

            $ids = array_keys($cart);
            $products = DB::table('san_pham')->whereIn('id', $ids)->get();

            $detail = [];
            foreach ($products as $row) {
                $soLuong = (int) ($cart[$row->id] ?? 1);

                $detail[] = [
                    'ma_don_hang' => $id_don_hang,
                    'laptop_id' => $row->id,
                    'so_luong' => $soLuong,
                    'don_gia' => $row->gia,
                ];

                $mailData[] = (object) [
                    'tieu_de' => $row->tieu_de,
                    'so_luong' => $soLuong,
                    'gia_ban' => $row->gia,
                ];
            }

            if (!empty($detail)) {
                DB::table('chi_tiet_don_hang')->insert($detail);
            }

            session()->forget('cart');
        });

        $user = Auth::user();
        if ($user) {
            $user->notify(new TestSendEmail($mailData));
        }

        return redirect()->route('cart')->with('success', 'Đặt hàng thành công!');
    }
}