@extends('frontend.layout.app')

@section('css')
    <style>
        .wrap-iten-in-cart .order-container .table.order-list th,
        .wrap-iten-in-cart .order-container .table.order-list td {
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .wrap-iten-in-cart .order-container .table.order-list td {
            border-bottom: 1px solid #ddd;
            padding-top: 15px;
            padding-bottom: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>đơn hàng</span></li>
        </ul>
    </div>

    <div class="main-content-area" style="">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">tất cả đơn hàng</h3>
                    <div class="table-responsive order-container">
                        @if ($orderLists->count() > 0)
                            <table class="table order-list table-primary">
                                <thead class="bg-red">
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Họ tên</th>
                                        <th style="min-width: 105px">Số điện thoại</th>
                                        <th class="address">Địa chỉ</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderLists as $item)
                                        <tr>
                                            <td><a style="color: var(--primary-color)"
                                                    href="{{ route('order_detail', ['order_code' => $item->order_code]) }}">#{{ $item->order_code }}</a>
                                            </td>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ implode(', ', [$item->address, $item->shipping_ward, $item->shipping_district, $item->shipping_province]) }}
                                            <td>{{ number_format($item->total_price, 0, '.', '.') }}đ</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i:s') }}</td>
                                            </td>
                                            <td>{{ $item->orderStatus->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orderLists->links('pagination::bootstrap-4') }}
                        @else
                            <li class="pr-cart-item text-center" style="list-style: none">
                                <div class="cart-empty">
                                    <img src="{{ asset('storage/app/cart-empty.png') }}" alt="">
                                    <p>Bạn chưa có đơn hàng nào</p>
                                    <a href="{{ route('home') }}">Mua sắm ngay</a>
                                </div>
                            </li>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
