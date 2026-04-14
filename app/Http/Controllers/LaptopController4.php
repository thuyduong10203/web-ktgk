<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaptopController4 extends Controller
{
    // Hiển thị trang quản lý sản phẩm
    public function indexAdmin()
    {
        // Lấy các sản phẩm có status là 1 
        $laptops = DB::table('san_pham')->where('status', 1)->get();
        
        return view('admin.index_admin', compact('laptops'));
    }

    // Xử lý xóa mềm 
    public function softDelete($id)
    {
        $laptop = DB::table('san_pham')->where('id', $id)->first();
        
        if ($laptop) {
            DB::table('san_pham')->where('id', $id)->update(['status' => 0]);
            
            return redirect()->back()->with('success', 'Đã xóa sản phẩm thành công!');
        }

        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
    }

}