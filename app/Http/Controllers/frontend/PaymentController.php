<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationEmail;
use App\Models\Order;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function paymentSuccess(Request $request)
    {
        $request->session()->forget('order_submitted');

        $order = Order::where('order_code', $request->order_code)->first();

        if (!$order) {
            return abort(404);
        }

        $totalNotDiscount = 0;
        $totalDiscount = 0;
        $products = $order->products->reverse();
        foreach ($products as  $product) {
            $totalNotDiscount += $product->pivot->order_detail_quantity * $product->price;

            if ($product->discount != 0) {
                $totalDiscount += $product->pivot->order_detail_quantity * $product->discount;
            }
        }
        return view('frontend.payment_success', compact('order', 'products', 'totalNotDiscount', 'totalDiscount'));
    }

    public function vnpayReturn(Request $request)
    {
        if ($request->vnp_ResponseCode == "00") {
            $order = Order::where('order_code', $request->vnp_TxnRef)->first();

            if ($order) {
                $order->order_status_id = 2;
                $order->update();
                Mail::to($order->email)->queue(new OrderConfirmationEmail($order));

                $request->session()->put('order_submitted', true);

                return redirect()->route('payment.success', ['order_code' => $order->order_code]);
            }
            return abort(404);
        }
        return abort(500);
    }

    public function paypalReturn(Request $request)
    {
        $provider = new PayPalClient();
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order = Order::where('order_code', $request->order_code)->first();

            if ($order) {
                $order->order_status_id = 2;
                $order->update();
                Mail::to($order->email)->queue(new OrderConfirmationEmail($order));

                $request->session()->put('order_submitted', true);

                return redirect()->route('payment.success', ['order_code' => $order->order_code]);
            }
            return abort(404);
        }
        return Redirect::route('payment.paypal.cancel');
    }

    public function cancelReturn(Request $request)
    {
        echo 'thanh toan paypal khong thanh cong';
    }
}
