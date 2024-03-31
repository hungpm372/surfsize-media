<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        .container {
            width: 60%;
            min-width: 900px;
            margin: 0px auto;
        }

        table {
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            color: #3f3f3f;
            line-height: 18px;
        }

        .container>.inner-container {
            width: 100%;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 4px rgba(0, 0, 0, .3);
            border: 1px solid #dddfed;
            padding: 30px;
            overflow-x: hidden
        }


        p {
            margin: 4px 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            color: #3f3f3f;
            line-height: 18px;
            font-weight: normal;

        }

        .w-50 {
            width: 50%;
        }

        th {
            font-size: 16px;
            color: #3f3f3f;
            font-weight: bold;
            padding: 15px 0 7px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        td {
            font-size: 16px;
            color: #3f3f3f;
            line-height: 18px;
            font-weight: normal;
            padding: 5px 0;
            vertical-align: top;
        }

        img {
            max-width: 100px;
            width: 100px;
        }

        table.list-product .bt {
            border-top: 1px solid #ddd;
        }

        table.list-product th {
            font-size: 16px;
            color: #fff;
            background: #fe0000;
            padding: 5px;
            font-weight: 500;
        }

        table.list-product td {
            padding-right: 10px;
            padding-left: 10px;
        }

        table.list-product a {
            color: inherit;
            word-wrap: break-word;
            white-space: normal;
            overflow: hidden;
            display: -webkit-box;
            text-overflow: ellipsis;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            text-decoration: none;
        }

        table.list-product a:hover {
            color: #fe0000;
        }

        a.submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.3);
            display: block;
            margin: 30px auto;
            max-width: 30%;
            width: 25%;
            text-align: center;
            text-decoration: none;
        }

        a.submit:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="inner-container">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p>Xin chào <b>{{ $order->fullname }}</b></p>
                            <p> Cảm ơn Anh/chị đã đặt hàng tại <b>{{ env('APP_NAME') }}</b></p>
                            <p style="border-bottom: 1px solid #ddd;padding-bottom: 15px;">Chúng tôi xác nhận rằng chúng tôi
                                đã nhận được đơn hàng của bạn với thông tin chi tiết như dưới đây.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="w-50">Thông tin mua hàng</th>
                                        <th class="w-50"> Địa chỉ giao hàng </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->fullname }}</td>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
                                        <td>{{ implode(', ', [$order->address, $order->shipping_ward, $order->shipping_district, $order->shipping_province]) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="w-50">Phương thức giao hàng</th>
                                        <th class="w-50">Phương thức thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Giao hàng tận nơi</td>
                                        <td>{{ $order->paymentMethod->method_name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="w-50">Thông tin đơn hàng</th>
                                        <th class="w-50"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mã đơn hàng: #{{ $order->order_code }}</td>
                                        <td>Ngày đặt hàng:
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 15px" colspan="2">
                                            <table style="border-collapse: collapse" class="list-product">
                                                <tr>
                                                    <th colspan="2">Sản phẩm</th>
                                                    <th>Đơn giá</th>
                                                    <th class="text-center">Số lượng</th>
                                                    <th class="text-right">Tổng tạm</th>
                                                </tr>
                                                @foreach ($order->products->reverse() as $item)
                                                    <tr>
                                                        <td style="max-width: 120px;width: 120px;"><img class="img-responsive thumbnail"
                                                                src="{{ $message->embed($item->featured_image) }}" alt="{{ $item->name }}">
                                                        </td>
                                                        <td>
                                                            <a target="_blank"
                                                                href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}">{{ $item->name }}</a>

                                                        </td>
                                                        <td>{{ number_format($item->price - $item->discount, 0, '.', '.') }}đ
                                                        </td>
                                                        <td class="text-center">x
                                                            {{ $item->pivot->order_detail_quantity }}</td>
                                                        <td class="text-right">
                                                            {{ number_format(($item->price - $item->discount) * $item->pivot->order_detail_quantity, 0, '.', '.') }}đ
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2" class="bt"></td>
                                                    <td colspan="2" class="bt">Tổng tiền:</td>
                                                    <td class="text-right bt">
                                                        <b>{{ number_format($order->total_price, 0, '.', '.') }}đ</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">Phí giao hàng:</td>
                                                    <td class="text-right">
                                                        <b>{{ number_format($order->shipping_fee, 0, '.', '.') }}đ</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">Thành tiền:</td>
                                                    <td class="text-right">
                                                        <b>{{ number_format($order->total_price + $order->shipping_fee, 0, '.', '.') }}đ</b>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            @if ($order->paymentMethod->code === 'cod')
                <div class="" style="margin-top: 30px">
                    <p>Để đảm bảo tính chính xác của đơn hàng, chúng tôi yêu cầu bạn xác nhận đơn hàng bằng cách nhấn vào nút
                        "Xác nhận đơn hàng" phía dưới. Vui lòng lưu ý rằng thông báo này có hiệu lực trong vòng 24 giờ kể từ khi
                        email này được gửi.</p>
                    <div class=""><a href="{{ route('confirm_order', ['order_code' => $order->order_code, 'token' => $order->confirmation_token]) }}" class="submit">Xác nhận
                            đơn
                            hàng</a></div>
                </div>
            @endif
            <div class="" style="margin-top: 30px">
                <p>Nếu Anh/chị có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua địa chỉ email <a
                        href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>. Chúng tôi rất
                    mong sớm nhận được phản hồi của bạn.</p>
                <p class="text-right"><i>Trân trọng,</i></p>
                <p class="text-right"><b>Ban quản trị {{ env('APP_NAME') }}</b></p>
            </div>
        </div>
    </div>

</body>

</html>
