<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function vnpayReturn(Request $request)
    {
        echo 'hehe';
        dd($request->all());
    }
}
