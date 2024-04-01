<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\District;
use App\Models\PaymentMethod;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    private $appName;

    public function __construct()
    {
        $this->appName = config('app.name');
    }

    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if (!$cart || $cart->products->count() == 0) {
            return redirect()->route('cart');
        }
        $total = 0;
        foreach ($cart->products as $key => $product) {
            $total += $product->pivot->cart_detail_quantity * ($product->price - $product->discount);
        }

        $user = Auth::user();
        $provinces = Province::all();
        $paymentMethods = PaymentMethod::all();

        $seo = [
            'title' => mb_convert_case("thông tin thanh toán | $this->appName", MB_CASE_TITLE, 'UTF-8'),
            'description' => "",
            'keywords' => '',
            'image' => null,
            'canonical' => null,
        ];

        return view('frontend.checkout', compact('user', 'provinces', 'total', 'paymentMethods', 'seo'));
    }

    public function getDistricts(Request $request)
    {
        $districts = District::where('province_id', $request->provinceId)->get();
        return response()->json($districts);
    }

    public function getwards(Request $request)
    {
        $wards = Ward::where('district_id', $request->districtId)->get();
        return response()->json($wards);
    }
}
