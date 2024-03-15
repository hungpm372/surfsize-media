@extends('frontend.layout.app')
@section('title')
    {{ mb_convert_case('chi tiết đơn hàng ', MB_CASE_TITLE, 'UTF-8') . $order->order_code }}
@endsection

@section('css')
    <style>
        .wrap-iten-in-cart {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
        }

        .wrap-iten-in-cart .order-wrap a {
            color: #333;
            text-transform: uppercase;
            transition: all 0.2s ease;
        }

        .wrap-iten-in-cart .order-wrap a:hover {
            color: #ff2832;
        }

        .wrap-iten-in-cart .order-wrap span,
        .wrap-iten-in-cart>span {
            text-transform: uppercase;
            color: #ff2832;
            margin-left: 15px;
        }

        .order-wrap {
            display: flex;
            align-items: center;
        }

        .wrap-iten-in-cart .order-wrap span {
            display: flex;
            align-items: center;
        }

        .wrap-iten-in-cart span i {
            font-size: 11px;
            margin-right: 4px;
        }
    </style>
@endsection
@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><a href="{{ route('order') }}" class="link">đơn hàng của tôi</a></li>
            <li class="item-link"><span>{{ $order->order_code }}</span></li>
        </ul>
    </div>
    <div class=" main-content-area">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">chi tiết đơn hàng <span class="order-code">{{ $order->order_code }}</span></h3>
                    @if ($order->order_status_id != 4 && $order->order_status_id != 3)
                        <div class="order-wrap">
                            <a id="cancel-order" href="#" data-url="{{ route('cancel_order') }}"
                                data-order-code="{{ $order->order_code }}">Hủy đơn hàng</a>
                            <span><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>{{ $order->orderStatus->name }}</span>
                        </div>
                    @else
                        <span>{{ $order->order_status_id == 4 ? 'Đã hủy' : 'Hoàn thành' }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 border">
                <div class="table-responsive">
                    <table class="table table-primary order-detail">
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td scope="row">
                                        <img src="{{ $item->featured_image }}" class="img-fluid" alt="{{ $item->name }}"
                                            loading="lazy">
                                    </td>
                                    <td>
                                        <div class="product-name"><a
                                                href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}">{{ $item->name }}</a>
                                        </div>
                                    </td>
                                    <td>{{ $item->code }}</td>
                                    <td>
                                        <div class="price-box">
                                            @if ($item->discount == 0)
                                                <span>{{ number_format($item->price, 0, '.', '.') }}đ</span>
                                            @else
                                                <del>{{ number_format($item->price, 0, '.', '.') }}đ</del>
                                                <span>{{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>x {{ $item->pivot->order_detail_quantity }}</td>
                                    <td>
                                        {{ number_format($item->pivot->order_detail_quantity * ($item->price - $item->discount), 0, '.', '.') }}đ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 order-detail-info">
                <div class="order-summary">
                    <h4 class="title-box">tóm tắt đơn hàng</h4>
                    <p class="summary-info"><span class="title">Ngày đặt hàng</span>
                        <b class="index">{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</b>
                    </p>
                    <p class="summary-info"><span class="title">Số lượng sản phẩm</span><b
                            class="index">{{ $order->products()->sum('order_detail_quantity') }}</b></p>
                    <p class="summary-info"><span class="title">Tổng tiền hàng</span>
                        <b class="index">{{ number_format($totalNotDiscount, 0, '.', '.') }}đ</b>
                    </p>
                    <p class="summary-info"><span class="title">Giảm giá</span>
                        <b class="index">{{ number_format($totalDiscount, 0, '.', '.') }}đ</b>
                    </p>
                    <p class="summary-info"><span class="title">Phí giao hàng</span><b class="index">0đ</b></p>
                    <p class="summary-info"><span class="title">Thành tiền</span><b
                            class="index">{{ number_format($totalNotDiscount - $totalDiscount, 0, '.', '.') }}đ</b></p>
                    <p class="summary-info total-info "></p>
                </div>
                <div class="order-summary">
                    <h4 class="title-box">hình thức thanh toán</h4>
                    <p class="summary-info"><span class="title">Thanh toán khi nhận hàng</span>
                    </p>
                    <p class="summary-info total-info "></p>
                </div>
                <div class="order-summary">
                    <h4 class="title-box">thông tin khách hàng</h4>
                    <p class="summary-info"><span class="title">{{ $order->fullname }}</span>
                    </p>
                    <p class="summary-info"><span class="title">{{ $order->email }}</span>
                    </p>
                    <p class="summary-info"><span class="title">{{ $order->phone }}</span>
                    </p>
                    <p class="summary-info"><span
                            class="title">{{ implode(', ', [$order->address, $order->shipping_ward, $order->shipping_district, $order->shipping_province]) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection


@section('js')
    <script src="{{ asset('frontend/js/select-address.js') }}"></script>
    <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#cancel-order').on('click', function(e) {
                e.preventDefault();
                let _this = $(this)
                let url = _this.data('url')
                let orderCode = _this.data('order-code')
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn hủy đơn hàng?',
                    text: "Bạn sẽ không thể hoàn tác hành động này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, hủy đơn hàng!',
                    cancelButtonText: 'Không'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                order_code: orderCode
                            },
                            method: 'POST',
                            dataType: 'json',
                            success: function(response) {
                                if (response == true) {
                                    Swal.fire({
                                        title: 'Đã hủy đơn hàng!',
                                        text: "Đơn hàng của bạn đã được hủy.",
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Đóng',
                                    }).then((result) => {
                                        _this.next().animate({
                                            opacity: 0
                                        }, 200, function() {
                                            $(this).text('Đã hủy')
                                                .animate({
                                                    opacity: 1
                                                }, 200);
                                        });

                                        _this.fadeOut(200, function() {
                                            $(this).remove();
                                        });
                                    })
                                }
                            }
                        })
                    }
                })
            });
        });
    </script>
@endsection
