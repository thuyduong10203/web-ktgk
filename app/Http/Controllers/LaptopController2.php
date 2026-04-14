<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaptopController2 extends Controller
{
	public function index(Request $request)
	{
		$keyword = trim((string) $request->query('keyword', ''));

		$laptopQuery = DB::table('san_pham');

		if ($keyword !== '') {
			$laptopQuery->where(function ($query) use ($keyword) {
				$query->where('tieu_de', 'like', "%{$keyword}%")
					->orWhere('ten', 'like', "%{$keyword}%");
			});
		}

		$laptops = $laptopQuery->orderBy('id')->get();

		return view('laptop.index', [
			'laptops' => $laptops,
			'keyword' => $keyword,
		]);
	}
}
