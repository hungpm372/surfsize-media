@extends('frontend.layout.app')

@section('css')
    <style>
        img {
            width: 80px;
            margin-top: 30px;
        }

        .box {
            background-color: var(--bg-color);
            padding: 15px;
            border-radius: 8px;
            margin-top: 50px;
            margin-bottom: 60px;
        }

        .box a.btn,
        .box button.btn.btn-confirm-order,
        .box button.btn.resend-email {
            margin-top: 12px;
            margin-bottom: 25px;
            display: inline-block;
        }

        p.paragraph {
            max-width: 65%;
            width: 65%;
            margin: 20px auto 30px;
            font-size: 15px;
            color: var(--primary-color);
        }
    </style>
@endsection


@section('content')
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="box">
                    @if ($status == true)
                        <img src="{{ asset('frontend/images/app/checked.png') }}" alt="Checked">
                        <h3>Xác nhận đơn hàng thành công</h3>
                        <p class="paragraph">Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi.</p>
                        <a href="{{ route('order_detail', ['order_code' => $order->order_code]) }}" class="btn btn-small">xem đơn hàng</a>
                    @else
                        <img src="{{ asset('frontend/images/app/cancel.png') }}" alt="Cancel">
                        <h3>Xác nhận đơn hàng không thành công</h3>
                        <p class="paragraph">Đơn hàng của bạn đã hết thời gian xác nhận hoặc mã xác nhận không chính xác.</p>
                        <button data-order-code="{{ $order->order_code }}" data-url="{{ route('resend_order_confirmation_email') }}" class="btn btn-small resend-email"
                            type="button">Gửi
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
