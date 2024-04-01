@extends('frontend.layout.app')

@section('title')
    {{ mb_convert_case('không tìm thấy trang yêu cầu', MB_CASE_TITLE, 'UTF-8') }}
@endsection

@section('css')
    <style>
        .error-page-wrap {
            margin-top: 50px;
            margin-bottom: 60px;
        }

        .error-page-wrap img {
            width: 220px;
            height: auto;
            max-width: 300px;
        }

        .error-page-wrap h3 {
            text-align: center;
            font-size: 18px;
        }

        .error-page-wrap p {
            margin-bottom: 5px;
        }

        .error-page-wrap #error {
            margin-bottom: 50px;
            width: 35%;
            max-width: 35%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="main-content-area">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="error-page-wrap">
                    <img src="{{ asset('storage/app/bubble-gum-error-404.gif') }}" alt="">
                    <h3 class="title-box">Địa chỉ không hợp lệ</h3>
                    <p class="paragraph">Địa chỉ URL bạn yêu cầu không tìm thấy trên server.</p>
                    <p class="paragraph">Có thể bạn gõ sai địa chỉ hoặc dữ liệu này đã bị xóa khỏi server.</p>
                    <a href="{{ route('home') }}" id="error" class="btn btn-small">quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
