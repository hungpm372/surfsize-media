<?php

namespace App\Http\Controllers\frontend;

use App\Helpers\OrderCodeHelper;
use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationEmail;
use App\Models\Cart;
use App\Models\District;
use App\Models\Order;
use App\Models\Province;
use App\Models\Ward;
use App\Services\PaymentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected $payment;

    public function __construct(PaymentService $payment)
    {
        $this->payment = $payment;
    }

    public function index(Request $request)
    {
        $orderLists = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('frontend.order', compact('orderLists'));
    }

    public function orderDetail($order_code)
    {
        $order = Order::where('order_code', $order_code)->first();
        $totalNotDiscount = 0;
        $totalDiscount = 0;
        $products = $order->products->reverse();
        foreach ($products as  $product) {
            $totalNotDiscount += $product->pivot->order_detail_quantity * $product->price;

            if ($product->discount != 0) {
                $totalDiscount += $product->pivot->order_detail_quantity * $product->discount;
            }
        }
        return view('frontend.order_detail', compact('order', 'products', 'totalNotDiscount', 'totalDiscount'));
    }

    public function processOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $cart = Cart::where('user_id', Auth::user()->id)->first();
            $cartItems = $cart->products;
            foreach ($cartItems as $item) {
                $totalPrice += ($item->price - $item->discount) * $item->pivot->cart_detail_quantity;
            }


            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->order_code = OrderCodeHelper::generateCode();
            $order->fullname = $request->fullname;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->shipping_province = Province::find($request->province)->name;
            $order->shipping_district = District::find($request->district)->name;
            $order->shipping_ward = Ward::find($request->ward)->name;
            $order->address = $request->address;
            $order->total_price = $totalPrice;
            $order->confirmation_token = Str::random(50);
            $order->expiration_date = Carbon::now()->addHours(24);
            $order->order_status_id = 1;
            $order->save();
            foreach ($cartItems as $item) {
                if ($item->quantity >= $item->pivot->cart_detail_quantity) {
                    $order->products()->attach(
                        $item->id,
                        [
                            'order_detail_quantity' => $item->pivot->cart_detail_quantity
                        ]
                    );
                    $item->decrement('quantity', $item->pivot->cart_detail_quantity);
                    $cart->products()->detach($item->id);
                }
            }

            DB::commit();

            Mail::to($order->email)->queue(new OrderConfirmationEmail($order));

            $request->session()->put('order_submitted', true);

            return redirect()->route('thank_you');
            // $data = $request->all();
            // $paymentMethod = $data['payment-method'];

            // switch ($paymentMethod) {
            //     case 'cod':
            //         $this->payment->processCOD($data);
            //         break;
            //     case 'zalopay':
            //         $this->payment->processZaloPay($data);
            //         break;
            //     case 'momo':
            //         $this->payment->processMoMo($data);
            //         break;
            //     case 'shopeepay':
            //         $this->payment->processShopeePay($data);
            //         break;
            //     case 'vnpay':
            //         return $this->payment->processVNPay($data);
            //     case 'paypal':
            //         return $this->payment->processPayPal($data);
            //     default:
            //         break;
            // }
            // return redirect()->route('payment');
        } catch (Exception $e) {
            DB::rollBack();
            return 'Đặt hàng không thành công';
        }
    }

    public function confirmOrder(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)
            ->where('confirmation_token', $request->token)
            ->first();

        if ($order) {
            if ($order->order_status_id == 1) {
                $expirationDate = Carbon::parse($order->expiration_date);
                $status = false;
                if ($expirationDate->isPast()) {
                    $order->confirmation_token = Str::random(50);
                    $order->expiration_date = Carbon::now()->addHours(24);
                } else {
                    $order->confirmation_token = null;
                    $order->expiration_date = null;
                    $order->order_status_id = 2;
                    $status = true;
                }
                $order->update();
                return view('frontend.confirm_order', compact('status', 'order'));
            }
        }
        return abort(404);
    }

    public function resendOrderConfirmationEmail(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->first();
        if ($order) {
            Mail::to($order->email)->queue(new OrderConfirmationEmail($order));
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->first();
        $order->order_status_id = 4;
        $order->update();

        foreach ($order->products as $product) {
            $product->increment('quantity', $product->pivot->order_detail_quantity);
        }

        return response()->json(true);
    }
}
