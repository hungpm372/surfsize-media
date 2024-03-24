<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function vnpayReturn(Request $request)
    {
        echo 'thanh toan vnpay thanh cong';
        dd($request->all());
    }

    public function paypalReturn(Request $request)
    {
        echo 'thanh toan paypal thanh cong';
        $provider = new PayPalClient();
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // return Redirect::route('payment.paypal.cancel');
            return 'thanh cong';
        } else {
            return Redirect::route('payment.paypal.cancel');
        }
    }

    public function cancelReturn(Request $request)
    {
        echo 'thanh toan paypal khong thanh cong';
        dd($request->all());
    }
}
