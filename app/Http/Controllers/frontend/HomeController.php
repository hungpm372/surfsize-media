<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $featuredProducts = Product::where('featured', 1)->inRandomOrder()->take(10)->get();
        $latestProducts = Product::latest()->take(20)->get();
        $latestProductQuantities = $latestProducts->count() % 2 == 0 ? $latestProducts->count() : $latestProducts->count() - 1;


        $seo = [
            'title' => mb_convert_case('Mobileworld | Dẫn đầu cùng công nghệ, cảm xúc không giới hạn', MB_CASE_TITLE, 'UTF-8'),
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'keywords' => config('app.name'),
            'image' => null,
            'canonical' => null,
        ];

        return view('frontend.home', compact('featuredProducts', 'latestProducts', 'latestProductQuantities', 'seo'));
    }

    public function aboutUs()
    {
        $seo = [
            'title' => mb_convert_case('Mobileworld | Về Chúng Tôi', MB_CASE_TITLE, 'UTF-8'),
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'keywords' => config('app.name'),
            'image' => null,
            'canonical' => null,
        ];
        return view('frontend.about_us', compact('seo'));
    }

    public function privacyPolicy()
    {
        $seo = [
            'title' => mb_convert_case('Mobileworld | Chính Sách Bảo Mật', MB_CASE_TITLE, 'UTF-8'),
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'keywords' => config('app.name'),
            'image' => null,
            'canonical' => null,
        ];
        return view('frontend.privacy_policy', compact('seo'));
    }

    public function termsAndConditions()
    {
        $seo = [
            'title' => mb_convert_case('Mobileworld | Điều Khoản & Điều Kiện', MB_CASE_TITLE, 'UTF-8'),
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'keywords' => config('app.name'),
            'image' => null,
            'canonical' => null,
        ];
        return view('frontend.terms_and_conditions', compact('seo'));
    }

    public function returnPolicy()
    {
        $seo = [
            'title' => mb_convert_case('Mobileworld | Chính Sách Hoàn Trả', MB_CASE_TITLE, 'UTF-8'),
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'keywords' => config('app.name'),
            'image' => null,
            'canonical' => null,
        ];
        return view('frontend.return_policy', compact('seo'));
    }

    public function contactUs()
    {
        $seo = [
            'title' => mb_convert_case('Mobileworld | Liên Hệ Chúng tôi', MB_CASE_TITLE, 'UTF-8'),
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'keywords' => config('app.name'),
            'image' => null,
            'canonical' => null,
        ];
        return view('frontend.contact_us', compact('seo'));
    }
}
