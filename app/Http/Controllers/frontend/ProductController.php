<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function productDetails($slug, $code)
    {
        $product = Product::where(compact('slug', 'code'))->first();
        $product->view_count = $product->view_count + 1;
        $product->update();

        $popularProducts = Product::orderBy('view_count', 'desc')->take(5)->get();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        $seo = [
            'title' => $product->name,
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'image' => $product->featured_image,
            'canonical' => null,
        ];
        
        return view('frontend.detail', compact('product', 'popularProducts', 'relatedProducts', 'seo'));
    }



    public function search(Request $request)
    {
        $keyword = $request->q;

        $title = 'tìm kiếm sản phẩm';

        $products = Product::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->get();

        return view('frontend.search', compact('title', 'products', 'keyword'));
    }
}
