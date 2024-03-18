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
                                <label for="frm-reg-lname">Tên</label>
                                <input type="text" id="frm-reg-lname" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        {{ $errors->first('name') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="frm-reg-email">Email</label>
                                <input type="text" id="frm-reg-email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="frm-reg-pass">Mật khẩu</label>
                                <input type="password" id="frm-reg-pass" name="password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <fieldset class="wrap-input {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <label for="frm-reg-cfpass">Xác nhận mật khẩu</label>
                                <input type="password" id="frm-reg-cfpass" name="password_confirmation"
                                    value="{{ old('password_confirmation') }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        {{ $errors->first('password_confirmation') }}</>
                                    </span>
                                @endif
                            </fieldset>
                            <input type="submit" class="btn btn-sign" value="Đăng ký">
                        </form>
                    </div>
                </div>
            </div>
            <!--end main products area-->
        </div>
    </div>
    <!--end row-->
@endsection
