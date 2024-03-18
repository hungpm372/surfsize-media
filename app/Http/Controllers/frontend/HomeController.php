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
            'title' => 'Dẫn đầu cùng công nghệ, cảm xúc không giới hạn',
            'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
            'image' => 'haha',
            'canonical' => null,
        ];

        return view('frontend.home', compact('featuredProducts', 'latestProducts', 'latestProductQuantities', 'seo'));
    }

    public function aboutUs()
    {
        return view('frontend.about_us');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy_policy');
    }

    public function termsAndConditions()
    {
        return view('frontend.terms_and_conditions');
    }

    public function returnPolicy()
    {
        return view('frontend.return_policy');
    }

    public function contactUs()
    {
        return view('frontend.contact_us');
    }
}
