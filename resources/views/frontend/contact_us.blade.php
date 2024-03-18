@extends('frontend.layout.app')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>liên hệ</span></li>
        </ul>
    </div>
    <div class=" main-content-area">
        <div class="row">
            <div class="wrap-contacts ">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-form">
                        <h2 class="box-title">để lại lời nhắn</h2>
                        <form action="#" method="get" name="frm-contact">

                            <label for="name">Họ và tên<span>*</span></label>
                            <input type="text" value="" id="name" name="name">

                            <label for="email">Email<span>*</span></label>
                            <input type="text" value="" id="email" name="email">

                            <label for="phone">Số điện thoại</label>
                            <input type="text" value="" id="phone" name="phone">

                            <label for="content">Nội dung</label>
                            <textarea name="content" id="content"></textarea>

                            <input type="submit" name="ok" value="Gửi">

                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-info">
                        <div class="wrap-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.6411089059593!2d108.21987141468368!3d16.03218748890382!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219ee598df9c5%3A0xaadb53409be7c909!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaeG6v24gdHLDumMgxJDDoCBO4bq1bmc!5e0!3m2!1svi!2s!4v1678286843669!5m2!1svi!2s"
                                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <h2 class="box-title">chi tiết liên hệ</h2>
                        <div class="wrap-icon-box">


                            <div class="icon-box-item">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Địa chỉ</b>
                                    <p>566 Núi Thành, Hoà Cường Nam, Hải Châu, Đà Nẵng, Việt Nam</p>
                                </div>
                            </div>
                            <div class="icon-box-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Email</b>
                                    <p>contact@dau.edu.vn</p>
                                </div>
                            </div>

                            <div class="icon-box-item">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Số điện thoại</b>
                                    <p>(+123) 456 789 - (+123) 666 888</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
