@extends('frontend.layout.app')
{{-- {{ dd($order) }} --}}
@section('css')
    <style>
        .wrap-payment-success {
            padding-bottom: 50px;
        }

        .wrap-payment-success .btn {
            max-width: 40%;
            margin: 30px auto 20px;
        }

        .wrap-payment-success .paragraph {
            color: var(--primary-color);
            max-width: 65%;
            width: 65%;
            margin: auto;
        }

        .wrap-payment-success .title-box {
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            margin: 35px 0 20px;
        }

        .wrap-payment-success .order-info .product-name {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .wrap-payment-success .order-info img {
            width: 60px;
            height: 60px;
        }

        .wrap-payment-success .order-info .table-primary {
            max-width: 750px;
            width: 750px;
            margin: 0px auto;
        }

        .wrap-payment-success .order-info .table-primary td,
        .wrap-payment-success .order-info .table-primary th {
            vertical-align: middle;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        .wrap-payment-success .order-info .table-primary td.no-border {
            border-bottom: none;
            border-top: none;
        }

        .wrap-payment-success .order-info .table-primary td.no-border-bottom {
            border-bottom: none;
        }

        .wrap-payment-success .order-info .table-primary td.no-border-top {
            border-top: none;
            font-size: 18px;
            font-weight: 700;
        }

        .wrap-payment-success .order-info .table-primary td:first-child,
        .wrap-payment-success .order-info .table-primary th:first-child {
            border-left: 1px solid #ddd;
            max-width: 50%;
            width: 50%;
        }

        .wrap-payment-success .order-info .table-primary td:last-child,
        .wrap-payment-success .order-info .table-primary th:last-child {
            border-right: 1px solid #ddd;
        }

        .wrap-payment-success .order-info .table-primary td:last-child,
        .wrap-payment-success .order-info .table-primary td:last-child a {
            font-weight: 500;
            color: var(--primary-color);
        }

        .wrap-payment-success .order-info.user-info .table-primary td:first-child {
            width: 30%;
            font-size: 14px;
            font-weight: 400;
        }

        .wrap-payment-success .order-info.user-info .table-primary td:last-child {
            font-size: 14px;
            color: #3f3f3f;
        }
    </style>
@endsection

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>đặt hàng</span></li>
        </ul>
    </div>
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-divider wrap-payment-success">
                    <h2 class="title-box">đặt hàng thành công</h2>
                    <a href="{{ route('home') }}" class="btn btn-small">khám phá thêm các sản phẩm khác tại đây</a>
                    <p class="paragraph">
                        @if ($order->paymentMethod->code === 'cod')
                            Hệ thống sẽ tự động gửi Email xác nhận đơn hàng đến hòm thư mà quý khách đã cung cấp.
                        @else
                            Thông tin đơn hàng đã được gửi đến địa chỉ email mà quý khách đã cung cấp. Xin vui lòng kiểm tra hòm thư của bạn để xem thông tin chi tiết. Cảm ơn quý khách
                            đã tin tưởng và mua hàng của chúng tôi!
                        @endif
                    </p>
                    <h2 class="title-box">thông tin đơn hàng</h2>
                    <div class="order-info">
                        <table class="table table-primary">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Đơn giá</th>
                                <th class="text-right">Thành tiền</th>
                            </tr>
                            @foreach ($products as $item)
                                <tr>
                                    <td class="text-left">
                                        <div class="product-name">
                                            <img src="{{ $item->featured_image }}" alt="{{ $item->name }}" loading="lazy">
                                            <span>{{ $item->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item->pivot->order_detail_quantity }}</td>
                                    <td class="text-center">{{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</td>
                                    <td class="text-right">{{ number_format($item->pivot->order_detail_quantity * ($item->price - $item->discount), 0, '.', '.') }}đ</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-left no-border" colspan="2">
                                    Mã đơn hàng
                                </td>
                                <td class="text-right no-border" colspan="2">
                                    <a href="{{ route('order_detail', ['order_code' => $order->order_code]) }}">#{{ $order->order_code }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border" colspan="2">
                                    Ngày đặt hàng
                                </td>
                                <td class="text-right no-border" colspan="2">
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('H:i:s d/m/Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border" colspan="2">
                                    Tổng tiền hàng
                                </td>
                                <td class="text-right no-border" colspan="2">
                                    {{ number_format($totalNotDiscount, 0, '.', '.') }}đ
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border" colspan="2">
                                    Giảm giá
                                </td>
                                <td class="text-right no-border" colspan="2">
                                    {{ number_format($totalDiscount, 0, '.', '.') }}đ
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border" colspan="2">
                                    Phí giao hàng
                                </td>
                                <td class="text-right no-border" colspan="2">
                                    {{ $order->shipping_fee }}đ
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border-top" colspan="2">
                                    Thành tiền
                                </td>
                                <td class="text-right no-border-top" colspan="2">
                                    {{ number_format($totalNotDiscount - $totalDiscount, 0, '.', '.') }}đ
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h2 class="title-box">thông tin nhận hàng</h2>
                    <div class="order-info user-info">
                        <table class="table table-primary">
                            <tr>
                                <td class="text-left no-border-bottom">Người nhận: </td>
                                <td class="text-left no-border-bottom">{{ $order->fullname }}</td>
                            </tr>
                            <tr>
                                <td class="text-left no-border">Email: </td>
                                <td class="text-left no-border">{{ $order->email }} </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border">Số điện thoại: </td>
                                <td class="text-left no-border">{{ $order->phone }} </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border">Địa chỉ: </td>
                                <td class="text-left no-border">{{ implode(', ', [$order->address, $order->shipping_ward, $order->shipping_district, $order->shipping_province]) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left no-border">Phương thức thanh toán: </td>
                                <td class="text-left no-border">{{ $order->paymentMethod->method_name }}</td>
                            </tr>
                            <tr>
                                <td class="text-left no-border-top">Phương thức giao hàng: </td>
                                <td class="text-left no-border-top">Chuyển phát nhanh</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
