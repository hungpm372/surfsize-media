@extends('frontend.layout.app')

@section('css')
    <style>
        img {
            width: 80px;
        }

        .box {
            padding: 100px 0;
        }

        a.btn.btn-confirm-order:hover,
        button.btn.btn-confirm-order:hover {
            color: #ffffff;
            background: #333333;
            border-color: #333333;
        }

        a.btn.btn-confirm-order,
        button.btn.btn-confirm-order {
            border: 0;
            border-radius: 0;
            color: #ffffff;
            text-align: center;
            font-size: 14px;
            line-height: 20px;
            padding: 10px 25px;
            margin-top: 12px;
            margin-bottom: 18px;
            text-transform: uppercase;
            background: #ff2832;
        }

        p {
            margin-bottom: 40px;
        }
    </style>
@endsection


@section('content')
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="box">
                    @if ($status == true)
                        <img src="{{ asset('storage/app/tick.jpg') }}" alt="">
                        <h3>Xác nhận đơn hàng thành công</h3>
                        <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi.</p>
                        <a href="{{ route('order_detail', ['order_code' => $order->order_code]) }}"
                            class="btn btn-confirm-order">xem đơn hàng</a>
                    @else
                        <img src="{{ asset('storage/app/cross.jpg') }}" alt="">
                        <h3>Xác nhận đơn hàng không thành công</h3>
                        <p>Đơn hàng của bạn đã hết thời gian xác nhận hoặc mã xác nhận không chính xác.</p>
                        <button data-order-code="{{ $order->order_code }}"
                            data-url="{{ route('resend_order_confirmation_email') }}"
                            class="btn btn-confirm-order resend-email" type="button">Gửi
                            lại email xác thực</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $('.resend-email').on('click', function(e) {
                let orderCode = $(this).data('order-code')
                let url = $(this).data('url')
                $.ajax({
                    url: url,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        order_code: orderCode
                    },
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            $('.resend-email').text('đã gửi lại email xác nhận').prop('disabled', true)
                        } else {
                            $('.resend-email').text('gửi email không thành công')
                        }
                    }
                });
            })
        });
    </script>
@endsection
