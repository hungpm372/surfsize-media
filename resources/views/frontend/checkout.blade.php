@extends('frontend.layout.app')
@section('title')
    {{ mb_convert_case('thủ tục thanh toán', MB_CASE_TITLE, 'UTF-8') }}
@endsection
@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>thủ tục thanh toán</span></li>
        </ul>
    </div>
    <div class=" main-content-area">
        <form method="POST" name="frm-billing">
            <div class="wrap-address-billing">
                <h3 class="box-title">địa chỉ giao hàng</h3>
                <p class="row-in-form">
                    <label for="fname">Họ tên<span> (*)</span></label>
                    <input id="fname" type="text" name="fullname" value="{{ $user->name }}">
                </p>

                <p class="row-in-form">
                    <label for="email">Email<span> (*)</span></label>
                    <input id="email" type="text" name="email" value="{{ $user->email }}">
                </p>
                <p class="row-in-form">
                    <label for="phone">Số điện thoại<span> (*)</span></label>
                    <input id="phone" type="text" name="phone" value="{{ $user->phone_number }}">
                </p>
                <p class="row-in-form">
                    <label for="province">Tỉnh/Thành phố<span> (*)</span></label>
                    <select id="province" class="except-chosen" name="province">
                        <option selected disabled value="-1">--- Vui lòng chọn tỉnh/thành phố ---</option>
                        @foreach ($provinces as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </p>
                <p class="row-in-form">
                    <label for="district">Quận/Huyện<span> (*)</span></label>
                    <select id="district" class="except-chosen" name="district">
                        <option selected disabled value="-1">--- Vui lòng chọn quận/huyện ---</option>
                    </select>
                </p>
                <p class="row-in-form">
                    <label for="ward">Phường/Xã<span> (*)</span></label>
                    <select id="ward" class="except-chosen" name="ward">
                        <option selected disabled value="-1">--- Vui lòng chọn phường/xã ---</option>
                    </select>
                </p>
                <p class="row-in-form">
                    <label for="city">Địa chỉ chi tiết<span> (*)</span></label>
                    <input id="city" type="text" name="address" value="">
                </p>
                @csrf
            </div>
            <div class="summary summary-checkout">
                <div class="summary-item payment-method">
                    <h4 class="title-box">Phương thức thanh toán</h4>
                    <div class="choose-payment-methods" style="border: none">
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-bank" value="bank" type="radio" checked>
                            <span>Thanh toán khi nhận hàng</span>
                            {{-- <span class="payment-desc">But the majority have suffered alteration in some form, by injected
                                humour, or randomised words which don't look even slightly believable</span> --}}
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-visa" value="visa" type="radio">
                            <span>Thanh toán bằng thẻ ATM</span>
                            {{-- <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span> --}}
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
                            <span>Thanh toán bằng Momo</span>
                            {{-- <span class="payment-desc">You can pay with your credit</span>
                            <span class="payment-desc">card if you don't have a paypal account</span> --}}
                        </label>
                    </div>
                    <p class="summary-info grand-total"><span>Tổng cộng</span> <span
                            class="grand-total-price">{{ number_format($total, 0, '.', '.') }}đ</span>
                    </p>
                    <button type="submit" class="btn btn-medium">đặt hàng ngay</button>
                </div>
                <div class="summary-item shipping-method">
                    <h4 class="title-box f-title">Phương thức giao hàng</h4>
                    <p class="summary-info"><span class="title">Chuyển phát nhanh</span></p>
                    <h4 class="title-box" style="padding-bottom: 15px">Mã giảm giá</h4>
                    <p class="row-in-form">
                        <input id="coupon-code" type="text" name="coupon-code" value=""
                            placeholder="Nhập mã giảm giá của bạn">
                    </p>
                    <a href="#" class="btn btn-small">Áp dụng</a>
                </div>
            </div>
        </form>

        {{-- slider --}}
        <div class="wrap-show-advance-info-box style-1 box-in-site">
            <h3 class="title-box">sản phẩm được xem nhiều nhất</h3>
            <div class="wrap-products">
                <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                    data-autoplay="true" data-autoplayTimeout="5000" data-loop="true" data-slideSpeed="1000"
                    data-nav="true" data-dots="false"
                    data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                    @foreach ($mostViewedProducts as $item)
                        <div class="product product-style-2 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                    title="{{ $item->name }}">
                                    <figure><img src="{{ $item->featured_image }}" width="214" height="214"
                                            alt="{{ $item->name }}" loading="lazy"></figure>
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
                                    class="product-name">
                                    <span>{{ $item->name }}</span>
                                </a>
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
    <script src="{{ asset('frontend/js/select-address.js') }}"></script>
@endsection
