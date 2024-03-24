<?php

namespace App\Services;

use App\Helpers\OrderCodeHelper;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentService
{
    public function processCOD($order)
    {
        dd($order);
    }

    public function processZaloPay($order)
    {
        dd($order);
    }

    public function processMoMo($order)
    {
        dd($order);
    }

    public function processShopeePay($order)
    {
        dd($order);
    }

    public function processVNPay($order)
    {
        $vnp_Url = env("VNP_URL");
        $vnp_Returnurl = route("payment.vnpay.return");
        $vnp_TmnCode = env("VNP_TMN_CODE");
        $vnp_HashSecret = env("VNP_HASH_SECRET");
        $vnp_TxnRef = OrderCodeHelper::generateCode();
        $vnp_OrderInfo = 'Mo ta don hang';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 50000 * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return Redirect::away($vnp_Url);
    }

    public function processPayPal($order)
    {
        $provider = new PayPalClient();
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('payment.paypal.return'),
                "cancel_url" => route('payment.paypal.cancel'),
            ],
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return Redirect::away($link['href']);
                }
            }
        } else {
            return Redirect::route('payment.paypal.cancel');
        }
    }
}
