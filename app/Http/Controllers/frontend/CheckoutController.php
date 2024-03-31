<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\OrderCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderConfirmationEmail;
use App\Models\Cart;
use App\Models\District;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Province;
use App\Models\Ward;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
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
        return view('frontend.checkout', compact('user', 'provinces', 'total', 'paymentMethods'));
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
