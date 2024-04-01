<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $appName;

    public function __construct()
    {
        $this->appName = config('app.name');
    }

    public function cart()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $products = [];
        $total = 0;
        $totalDiscount = 0;
        $cartStatus = true;
        if ($cart) {
            $products = $cart->products->reverse();
            foreach ($products as $key => $product) {
                if ($product->quantity < $product->pivot->cart_detail_quantity) {
                    $cartStatus = false;
                } else {
                    $total += $product->pivot->cart_detail_quantity * ($product->price - $product->discount);
                    $totalDiscount += $product->pivot->cart_detail_quantity * $product->discount;
                }
            }
        }

        $seo = [
            'title' => mb_convert_case("giỏ hàng của tôi | $this->appName", MB_CASE_TITLE, 'UTF-8'),
            'description' => "Thỏa sức mua sắm qua mạng hàng trăm sản phẩm điện thoại di động tại $this->appName với giá rẻ hơn và khuyến mãi hấp dẫn!",
            'keywords' => $this->appName,
            'image' => null,
            'canonical' => null,
        ];

        return view(
            'frontend.cart',
            compact('products', 'total', 'totalDiscount', 'cartStatus', 'seo')
        );
    }

    public function addProductToCart(Request $request)
    {
        $productId = $request->id;
        $price = $request->price;
        $quantity = $request->quantity;

        if ($quantity > Product::find($productId)->quantity) {
            return response()->json(['status' => false]);
        }

        $userId = Auth::user()->id;

        $cart = Cart::firstOrCreate(['user_id' => $userId]);
        if ($cart->products()->where('product_id', $productId)->count() == 1) {
            $product = $cart->products()->where('product_id', $productId)->first();
            $quantity += $product->pivot->cart_detail_quantity;
            if ($quantity > $product->quantity) {
                return response()->json(['status' => false]);
            }
            $cart->products()->sync([
                $productId => [
                    'cart_detail_quantity' => $quantity,
                    'cart_detail_price' => $price
                ]
            ]);
            return response()->json(['status' => true]);
        }

        $cart->products()->attach(
            $productId,
            [
                'cart_detail_quantity' => $quantity,
                'cart_detail_price' => $price
            ]
        );

        return response()->json(['status' => true]);
    }


    public function removeProductFromCart(Request $request)
    {
        $productId = $request->id;
        $cart = Cart::where('user_id', Auth::user()->id)->first();

        if ($cart->products()->where('product_id', $productId)->exists()) {
            $cart->products()->detach($productId);
            $quantityUpdate = $cart->products()->sum('cart_detail_quantity');
            return response()->json(['status' => true, 'quantity' => $quantityUpdate]);
        }
        return response()->json(['status' => false]);
    }
}
