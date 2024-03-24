<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\OrderCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderConfirmationEmail;
use App\Models\Cart;
use App\Models\District;
use App\Models\Order;
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
        return view('frontend.checkout', compact('user', 'provinces', 'total'));
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

    public function processCheckout(CheckoutRequest $request)
    {
        DB::beginTransaction();
        dd($request->all());
        try {
            // $totalPrice = 0;
            // $cart = Cart::where('user_id', Auth::user()->id)->first();
            // $cartItems = $cart->products;
            // foreach ($cartItems as $item) {
            //     $totalPrice += ($item->price - $item->discount) * $item->pivot->cart_detail_quantity;
            // }


            // $order = new Order();
            // $order->user_id = Auth::user()->id;
            // $order->order_code = OrderCodeHelper::generateCode();
            // $order->fullname = $request->fullname;
            // $order->email = $request->email;
            // $order->phone = $request->phone;
            // $order->shipping_province = Province::find($request->province)->name;
            // $order->shipping_district = District::find($request->district)->name;
            // $order->shipping_ward = Ward::find($request->ward)->name;
            // $order->address = $request->address;
            // $order->total_price = $totalPrice;
            // $order->confirmation_token = Str::random(50);
            // $order->expiration_date = Carbon::now()->addHours(24);
            // $order->order_status_id = 1;
            // $order->save();
            // foreach ($cartItems as $item) {
            //     if ($item->quantity >= $item->pivot->cart_detail_quantity) {
            //         $order->products()->attach(
            //             $item->id,
            //             [
            //                 'order_detail_quantity' => $item->pivot->cart_detail_quantity
            //             ]
            //         );
            //         $item->decrement('quantity', $item->pivot->cart_detail_quantity);
            //         $cart->products()->detach($item->id);
            //     }
            // }

            // DB::commit();

            // Mail::to($order->email)->queue(new OrderConfirmationEmail($order));

            // $request->session()->put('order_submitted', true);

            // return redirect()->route('thank_you');
        } catch (Exception $e) {
            DB::rollBack();
            return 'Đặt hàng không thành công';
        }
    }

    public function thankyou(Request $request)
    {
        $request->session()->forget('order_submitted');

        return view('frontend.thankyou');
    }
}
