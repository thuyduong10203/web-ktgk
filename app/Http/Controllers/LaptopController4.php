<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TestSendEmail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LaptopController4 extends Controller
{
    public function indexAdmin()
    {
        $laptops = DB::table('san_pham')->where('status', 1)->get();
        
        return view('admin.index_admin', compact('laptops'));
    }

    public function softDelete($id)
    {
        $laptop = DB::table('san_pham')->where('id', $id)->first();
        
        if ($laptop) {
            DB::table('san_pham')->where('id', $id)->update(['status' => 0]);
            
            return redirect()->back()->with('success', 'Đã xóa sản phẩm thành công!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
    }

    function testemail()
        {
        $user = User::find(2);
        $donHang = DB::select("select * from chi_tiet_don_hang c, san_pham s
        where c.laptop_id = s.id
        and c.ma_don_hang = 10");
        $user->notify(new TestSendEmail($donHang));
        }

    public function datHang(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart');

        if ($user && $cart) {
            $user->notify(new TestSendEmail($cart));
            session()->forget('cart');
            return redirect()->back()->with('success', 'Đặt hàng thành công! Email đã được gửi.');
        }

        return redirect()->back()->with('error', 'Đặt hàng thất bại.');
    }
}
