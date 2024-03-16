<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="EYz-pvIEKRcdhEso6BXEckhtfjVWnaWRVJf1eKdjIJ0" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/color-01.css') }}">
    @yield('css')
</head>

<body class="home-page home-01 ">





    @include('frontend.blocks.header')

    <main id="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('frontend.blocks.footer')


    <script src="{{ asset('frontend/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('frontend/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('frontend/js/functions.js') }}"></script>
    <script>
        $(document).ready(function(){var t=window.location.href.split("?")[0].replace("#","").replace(/\/$/,""),r=!1;$(".primary .menu-item").each(function(a){$(this).children().first().attr("href")==t&&($(this).addClass("home-icon"),r=!0)}),r||$(".primary .menu-item").first().addClass("home-icon");var a=$("#back-to-top-btn");$(window).on("scroll",function(){$(this).scrollTop()>100?a.css("transform","translate3d(0px, 0, 0)"):a.css("transform","translate3d(70px, 0, 0)")}),a.on("click",function(t){$("html, body").animate({scrollTop:0},500)})});
    </script>
    <script>
        $(document).ready(function(){var i=0;$('input[name="q"]').keyup(function(e){var s=$(this).val();if($(".search-result-box").html(""),""!=s){let t=RegExp(s,"i");i&&clearTimeout(i),i=setTimeout(function(){$.getJSON("/json/products.json",function(i){$.each(i,function(i,e){if(-1!=e.name.search(t)){$(".search-result-box").css({opacity:1,visibility:"visible"}).show();let s=e.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g,"."),a=(e.price-e.discount).toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");$(".search-result-box").append('<li><a href="/product/'+e.slug+"-"+e.code+'"><div class="img-box"><img loading="lazy" src="'+e.featured_image+'" alt="'+e.name+'"></div><div class="info-box"><div class="info-title">'+e.name+'</div><div class="info-price">'+(0==e.discount?'<div class="price-sale">'+s+"đ</div>":'<div class="price-sale">'+a+'đ</div><div class="price-origins">'+s+"đ</div>")+"</div></div></a></li>")}})})},200)}else $(".search-result-box").css({opacity:0,visibility:"hidden"}).html("")}),$(document).on("click",".search-result-box li a",function(i){i.preventDefault();let e=$(this).attr("href");$(this).closest(".search-result-box").html(""),location.href=e}),$(document).mouseup(function(i){var e=$(".search-result-box");e.is(i.target)||0!==e.has(i.target).length||e.html("")})});
    </script>
    @yield('js')

</body>

</html>
