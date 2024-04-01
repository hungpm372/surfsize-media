<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $appName;

    public function __construct()
    {
        $this->appName = config('app.name');
    }

    public function showProductsInCategory(Request $request, $slug)
    {
        $title = Category::where('slug', $slug)->first()->name;
        $category = Category::where('slug', $slug)->first();
        if ($request->sort_by == 'price' && $request->sort_order == 'asc') {
            $products = $category->products()/*->whereBetween('price', [$request->min, $request->max])*/->orderBy('price', 'asc')->get();
        } else if ($request->sort_by == 'price' && $request->sort_order == 'desc') {
            $products = $category->products()/*->whereBetween('price', [$request->min, $request->max])*/->orderBy('price', 'desc')->get();
        } else {
            $products = $category->products;
        }

        $seo = [
            'title' => mb_convert_case("Điện thoại $title chính hãng, Trả góp 0% | $this->appName", MB_CASE_TITLE, 'UTF-8'),
            'description' => "Mua sản phẩm $title hàng chính hãng, giao nhanh, cam kết hoàn tiền 200% nếu hàng giả, nhiều mã giảm giá hôm nay, freeship, giao nhanh 2h. Mua ngay tại $this->appName!",
            'keywords' => implode(', ', [$this->appName, $title]),
            'image' => null,
            'canonical' => null,
        ];

        return view('frontend.shop', compact('title', 'products', 'slug', 'seo'));
    }

    public function filter(Request $request)
    {
        return response()->json(Product::whereBetween('price', [$request->min, $request->max])->get());
    }
}
