<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if (!request()->is('admin/*')) {
                $categories = Category::where('status', 'active')->get();

                $productQuantities = 0;
                $productQuantitiesAvailable = 0;
                if (Auth::check()) {
                    $cart = Cart::where('user_id', Auth::user()->id)->first();
                    if ($cart) {
                        $productQuantities = $cart->products()->sum('cart_detail_quantity');
                        foreach ($cart->products as $item) {
                            if ($item->quantity > $item->pivot->cart_detail_quantity) {
                                $productQuantitiesAvailable += $item->pivot->cart_detail_quantity;
                            }
                        }
                    }
                }

                $popularProducts = Product::orderBy('view_count', 'desc')->take(5)->get();
                $mostViewedProducts = Product::orderBy('view_count', 'desc')->take(10)->get();
                $colorLists = Product::distinct()->pluck('color')->map(function ($color) {
                    return Str::lower(explode(' ', $color)[0]);
                })->unique();

                $seo = [
                    'title' => 'Title',
                    'description' => 'Tìm kiếm và mua sắm điện thoại di động trực tuyến với sự đa dạng và chất lượng tuyệt vời. Khám phá ngay để có trải nghiệm mua sắm tuyệt vời chỉ có ở Mobileworld!',
                    'image' => null,
                    'canonical' => null,
                ];

                $data = [
                    'productQuantities' => $productQuantities,
                    'productQuantitiesAvailable' => $productQuantitiesAvailable,
                    'categories' => $categories,
                    'popularProducts' => $popularProducts,
                    'mostViewedProducts' => $mostViewedProducts,
                    'colorLists' => $colorLists,
                    'seo' => $seo
                ];

                $view->with($data);
            } else if (request()->is('admin/order/*')) {
                $data = [
                    'active' => 'active',
                    'selected' => 'selected'
                ];

                $view->with($data);
            }
        });
    }
}
