<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 100%;
        }

        table {
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            color: #444;
            line-height: 18px;
        }

        .container>* {
            width: 70%;
            margin: 0 auto;
        }


        p {
            margin: 4px 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #444;
            line-height: 18px;
            font-weight: normal;

        }

        .w-50 {
            width: 50%;
        }

        th {
            font-size: 15px;
            color: #444;
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
            font-size: 13px;
            color: #444;
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
            font-size: 13px;
            color: white;
            background: var(--primary-color);
            padding: 5px;
            font-weight: 700;
        }

        table.list-product td {
            padding-right: 5px;
            padding-left: 5px;
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
            color: var(--primary-color);
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
                                    <th class="w-50">Phương thức vận chuyển</th>
                                    <th class="w-50">Phương thức thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Thanh toán khi nhận hàng (COD)</td>
                                    <td>Giao hàng tận nơi</td>
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
                                    <td colspan="2">
                                        <table class="list-product">
                                            <tr>
                                                <th colspan="2">Sản phẩm</th>
                                                <th>Đơn giá</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-right">Tổng tạm</th>
                                            </tr>
                                            @foreach ($order->products->reverse() as $item)
                                                <tr>
                                                    <td><img class="img-responsive thumbnail"
                                                            src="{{ $message->embed(asset('storage/products/' . $item->featured_image)) }}"
                                                            alt=""></td>
                                                    <td style="max-width: 300px;width: 300px;">
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
        <div class="" style="margin-top: 30px">
            <p>Để đảm bảo tính chính xác của đơn hàng, chúng tôi yêu cầu bạn xác nhận đơn hàng bằng cách nhấn vào nút
                "Xác nhận đơn hàng" phía dưới. Vui lòng lưu ý rằng thông báo này có hiệu lực trong vòng 24 giờ kể từ khi
                email này được gửi.</p>
            <div class=""><a
                    href="{{ route('confirm_order', ['order_code' => $order->order_code, 'token' => $order->confirmation_token]) }}"
                    class="submit">Xác nhận đơn hàng</a></div>
        </div>
        <div class="" style="margin-top: 30px">
            <p>Nếu Anh/chị có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua địa chỉ email <a
                    href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">{{ env('MAIL_FROM_ADDRESS') }}</a>. Chúng tôi rất
                mong sớm nhận được phản hồi của bạn.</p>
            <p class="text-right"><i>Trân trọng,</i></p>
            <p class="text-right"><b>Ban quản trị {{ env('APP_NAME') }}</b></p>
        </div>
    </div>

    <script src="{{ asset('frontend/js/jquery-1.12.4.minb8ff.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
</body>

</html>
