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
    private $appName;

    public function __construct()
    {
        $this->appName = config('app.name');
    }

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

        $keywordArr = $product->tags->pluck('name')->toArray();
        $keywordArr[] = $this->appName;

        $seo = [
            'title' => mb_convert_case("$product->name | Mobileworld", MB_CASE_TITLE, 'UTF-8'),
            'description' => "Mua $product->name - Hàng Chính Hãng - tại $this->appName với giá cực kỳ hấp dẫn. Chúng tôi cam kết hoàn tiền 200% nếu phát hiện hàng giả. Đừng bỏ lỡ cơ hội nhận nhiều mã giảm giá hôm nay cùng dịch vụ freeship và giao hàng nhanh trong vòng 24 giờ. Mua hàng dễ dàng và thanh toán an toàn tại $this->appName. Mua ngay để nhận ưu đãi!",
            'keywords' => implode(', ', $keywordArr),
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

        $seo = [
            'title' => mb_convert_case("tìm kiếm $keyword | Mobileworld", MB_CASE_TITLE, 'UTF-8'),
            'description' => "Tìm kiếm $keyword chính hãng, giá rẻ chỉ có tại $this->appName!",
            'keywords' => implode(', ', [$this->appName, $keyword]),
            'image' => null,
            'canonical' => null,
        ];

        return view('frontend.search', compact('title', 'products', 'keyword', 'seo'));
    }
}
