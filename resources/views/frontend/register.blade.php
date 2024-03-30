@extends('frontend.layout.app')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>đăng ký</span></li>
        </ul>
    </div>
    <div class=" main-content-area">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class="wrap-login-item ">
                    <div class="register-form form-item">
                        <form class="form-stl" action="{{ route('register') }}" name="frm-login" method="POST">
                            @csrf
                            <fieldset class="wrap-title">
                                <h3 class="form-title">Tạo tài khoản</h3>
                            </fieldset>
                            <fieldset class="wrap-input {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input type="text" id="frm-reg-lname" name="name" value="{{ old('name') }}" placeholder="Họ tên">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        {{ $errors->first('name') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="text" id="frm-reg-email" name="email" value="{{ old('email') }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input {{ $errors->has('password') ? 'has-error' : '' }}">
                                <input type="password" id="frm-reg-pass" name="password" value="{{ old('password') }}" placeholder="Mật khẩu">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <input type="password" id="frm-reg-cfpass" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Xác nhận mật khẩu">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        {{ $errors->first('password_confirmation') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <button type="submit" class="btn btn-submit btn-medium">Đăng ký</button>
                            <div class="spacer">Hoặc</div>
                            <button type="button" class="btn btn-fb btn-medium">
                                <img src="{{ asset('frontend/images/app/facebook.svg') }}" alt="Đăng ký bằng facebook">
                                Đăng ký bằng facebook
                            </button>
                            <button type="button" class="btn btn-gg btn-medium">
                                <img src="{{ asset('frontend/images/app/google.svg') }}" alt="Đăng ký bằng google">
                                Đăng ký bằng google
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!--end main products area-->
        </div>
    </div>
    <!--end row-->
@endsection
