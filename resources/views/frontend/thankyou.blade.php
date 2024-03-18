@extends('frontend.layout.app')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>đặt hàng</span></li>
        </ul>
    </div>
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12 text-center pt-20 pb-50">
                <h2>Cảm ơn quý khách đã mua hàng</h2>
                <p>Hệ thống sẽ tự động gửi Email xác nhận đơn hàng đến hòm thư mà quý khách đã cung cấp.</p>
                <a href="{{ route('home') }}" class="btn btn-submit btn-submitx">tiếp tục mua hàng</a>
            </div>
        </div>
    </div>
@endsection
