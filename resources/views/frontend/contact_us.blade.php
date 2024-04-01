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

                            <label for="name">Họ và tên<span> (*)</span></label>
                            <input type="text" value="" id="name" name="name">

                            <label for="email">Email<span> (*)</span></label>
                            <input type="text" value="" id="email" name="email">

                            <label for="phone">Số điện thoại<span> (*)</span></label>
                            <input type="text" value="" id="phone" name="phone">

                            <label for="content">Nội dung<span> (*)</span></label>
                            <textarea name="content" id="content"></textarea>

                            <button type="submit" class="btn btn-small">Gửi</button>

                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="contact-box contact-info">
                        <div class="wrap-map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7669.347459605433!2d108.21906359434477!3d16.030491200246082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219efdce1b043%3A0x17300ec28e6c7a09!2zSG_DoCBDxrDhu51uZyBOYW0sIEjhuqNpIENow6J1LCDEkMOgIE7hurVuZywgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1711954001772!5m2!1svi!2s"
                                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <h2 class="box-title">chi tiết liên hệ</h2>
                        <div class="wrap-icon-box">


                            <div class="icon-box-item">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Địa chỉ</b>
                                    <p>Hoà Cường Nam, Hải Châu, Đà Nẵng, Việt Nam</p>
                                </div>
                            </div>
                            <div class="icon-box-item">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="right-info">
                                    <b>Email</b>
                                    <p>mobileworldshop347@gmail.com</p>
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
