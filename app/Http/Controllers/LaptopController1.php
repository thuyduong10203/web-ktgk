<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaptopController1 extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort');

        $query = DB::table('san_pham');

        if ($sort === 'asc') {
            $query->orderBy('gia', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('gia', 'desc');
        } else {
            $query->orderByDesc('id');
        }

        $products = $query
            ->limit(20)
            ->get();

        return view('laptop.index', [
            'products' => $products,
            'sort' => $sort,
        ]);
    }

    public function theloai(Request $request, $id)
    {
        $category = DB::table('danh_muc_laptop')->where('id', $id)->first();
        if (!$category) {
            abort(404);
        }

        $sort = $request->query('sort');

        $query = DB::table('san_pham')
            ->where('id_danh_muc', $id);

        if ($sort === 'asc') {
            $query->orderBy('gia', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('gia', 'desc');
        } else {
            $query->orderByDesc('id');
        }

        $products = $query->get();

        return view('laptop.theloai', [
            'products' => $products,
            'category' => $category,
            'sort' => $sort,
        ]);
    }

    public function image($filename)
    {
        $path = 'image/'.$filename;

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return response()->file(storage_path('app/'.$path));
    }
}
