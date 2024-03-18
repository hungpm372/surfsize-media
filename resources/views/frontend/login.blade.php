@extends('frontend.layout.app')

@section('css')
    <style>
        .my-alert {
            position: fixed;
            top: 150px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
            width: 350px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }

        .my-alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0c5460;
        }

        .my-fade-out {
            animation: myFadeOut 5s forwards;
        }

        @keyframes myFadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>đăng nhập</span></li>
        </ul>
    </div>
    <div class="main-content-area">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class="wrap-login-item ">
                    <div class="login-form form-item form-stl">
                        <form name="frm-login" method="POST">

                            @csrf

                            <fieldset class="wrap-title">
                                <h3 class="form-title">đăng nhập tài khoản của bạn</h3>
                            </fieldset>

                            <fieldset class="wrap-input {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="frm-login-uname">Email:</label>
                                <input type="text" id="frm-login-uname" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        {{ $errors->first('email') }}</>
                                    </span>
                                @endif
                            </fieldset>

                            <fieldset class="wrap-input {{ $errors->has('password') ? 'has-error' : '' }}">
                                <label for="frm-login-pass">Mật khẩu:</label>
                                <input type="password" id="frm-login-pass" name="password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        {{ $errors->first('password') }}</>
                                    </span>
                                @endif
                            </fieldset>

                            <fieldset class="wrap-input">
                                <label class="remember-field">
                                    <input class="frm-input " name="rememberme" value="forever"
                                        type="checkbox"><span>Remember me</span>
                                </label>
                                <a class="link-function left-position" href="#" title="Forgotten password?">Quên mật
                                    khẩu?</a>
                            </fieldset>

                            <input type="submit" class="btn btn-submit" value="Đăng nhập">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="my-alert my-alert-success my-fade-out">
            {{ session('success') }}
        </div>
    @endif
@endsection
