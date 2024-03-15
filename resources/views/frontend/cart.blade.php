@extends('frontend.layout.app')
@section('title')
    {{ mb_convert_case('giỏ hàng', MB_CASE_TITLE, 'UTF-8') }}
@endsection

@section('css')
    <style>
        .wrap-price {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .wrap-price span p,
        .wrap-price del p,
        .price-field.sub-total p {
            margin-bottom: 0;
        }

        .price-field.produtc-price .wrap-price {
            padding-right: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>giỏ hàng</span></li>
        </ul>
    </div>
    <div class="main-content-area">
        <div class="wrap-iten-in-cart">
            <h3 class="box-title">giỏ hàng của tôi</h3>
            <ul class="products-cart">
                @forelse ($products as $item)
                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{ $item->featured_image }}" alt="{{ $item['name'] }}" loading="lazy">
                            </figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product"
                                href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}">{{ $item->name }}</a>
                        </div>
                        <div class="price-field produtc-price">
                            <div class="wrap-price">
                                @if ($item->discount == 0)
                                    <span class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</span>
                                @else
                                    <span>
                                        <p class="product-price">
                                            {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</p>
                                    </span>
                                    <del>
                                        <p class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</p>
                                    </del>
                                @endif
                            </div>
                            @if ($item->pivot->cart_detail_quantity > $item->quantity)
                                <div class="badge">Hết hàng</div>
                            @endif
                        </div>
                        <div class="quantity">
                            <div class="quantity-input">
                                <input type="text" name="product-quatity"
                                    value="{{ $item->pivot->cart_detail_quantity }}" data-max="{{ $item->quantity }}">
                                <a class="btn btn-increase" href="#"></a>
                                <a class="btn btn-reduce" href="#"></a>
                            </div>
                        </div>
                        <div class="price-field sub-total">
                            <p class="price">
                                {{ number_format(($item->price - $item->discount) * $item->pivot->cart_detail_quantity, 0, '.', '.') }}đ
                            </p>
                        </div>
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title="Xóa"
                                data-url="{{ route('remove_product_from_cart') }}" data-id="{{ $item->id }}">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                @empty
                    <li class="pr-cart-item text-center">
                        <div class="cart-empty">
                            <img src="{{ asset('storage/app/cart-empty.png') }}" alt="">
                            <p>Không có sản phẩm nào trong giỏ hàng</p>
                            <a href="{{ route('home') }}">Mua sắm ngay</a>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="shopping-cart">
            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">tổng tiền giỏ hàng</h4>
                    <p class="summary-info"><span class="title">Số lượng sản phẩm</span><b
                            class="index">{{ $productQuantitiesAvailable }}</b></p>
                    <p class="summary-info"><span class="title">Tổng tiền hàng</span><b
                            class="index">{{ number_format($total, 0, '.', '.') }}đ</b></p>
                    <p class="summary-info"><span class="title">Giảm giá</span><b
                            class="index">{{ number_format($totalDiscount, 0, '.', '.') }}đ</b></p>
                    <p class="summary-info"><span class="title">Phí giao hàng</span><b class="index">0đ</b></p>
                    <p class="summary-info total-info "><span class="title">Tổng thanh toán</span><b
                            class="index">{{ number_format($total, 0, '.', '.') }}đ</b></p>
                </div>
                <div class="checkout-info">
                    @if ($productQuantities > 0 && $productQuantitiesAvailable > 0)
                        <a class="btn btn-checkout" href="{{ route('checkout') }}">Thanh toán</a>
                    @else
                        <a class="btn btn-checkout" href="{{ route('home') }}">tìm kiếm sản phẩm khác</a>
                    @endif
                    @if (!$cartStatus)
                        <p style="color: #ff2832">Rất tiếc, một số sản phẩm đã hết hàng và không thể được đặt hàng, vui lòng
                            kiểm tra lại giỏ hàng!</p>
                    @endif
                    <a class="link-to-shop" href="{{ route('home') }}">Tiếp tục mua hàng<i class="fa fa-arrow-circle-right"
                            aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear" href="#">Xóa Tất Cả</a>
                    <a class="btn btn-update" href="#">Cập nhật giỏ hàng</a>
                </div>
            </div>
        </div>

        <div class="wrap-show-advance-info-box style-1 box-in-site">
            <h3 class="title-box">sản phẩm được xem nhiều nhất</h3>
            <div class="wrap-products">
                <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                    data-autoplay="true" data-autoplayTimeout="5000" data-loop="true" data-slideSpeed="1000" data-nav="true"
                    data-dots="false"
                    data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                    @foreach ($mostViewedProducts as $item)
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                    title="{{ $item->name }}">
                                    <figure><img src="{{ $item->featured_image }}" width="214" height="214"
                                            alt="{{ $item->name }}" loading="lazy">
                                    </figure>
                                </a>
                                <div class="group-flash">
                                    <span class="flash-item sale-label">sale</span>
                                </div>
                                <div class="wrap-btn">
                                    <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                        class="function-link">quick view</a>
                                </div>
                            </div>
                            <div class="product-info">
                                <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                    class="product-name"><span>{{ $item->name }}</span></a>
                                <div class="wrap-price">
                                    @if ($item->discount == 0)
                                        <span class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</span>
                                    @else
                                        <span>
                                            <p class="product-price">
                                                {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</p>
                                        </span>
                                        <del>
                                            <p class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</p>
                                        </del>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>

    </div>
@endsection



@section('js')
@endsection
