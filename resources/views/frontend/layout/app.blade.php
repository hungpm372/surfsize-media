<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="revisit-after" content="1 days" />
    <meta name="google-site-verification" content="EYz-pvIEKRcdhEso6BXEckhtfjVWnaWRVJf1eKdjIJ0" />
    <meta name="msvalidate.01" content="B6956DA48CD341B3CE84F27A00AE20D1" />
    <meta name='dmca-site-verification' content='RFFodXdxMnNjSitkU05HcW1DUFZMYlVwbkcyc2FqZ3R4VDhsQURYQ0lLND01' />
    <meta name="ahrefs-site-verification" content="5453343cbe64065a74d95f8a0bcc29560c518a7674ac59a385581abb6825a2ed" />
    <meta name="p:domain_verify" content="95885e8141a94cd2718709ddaaeea07d" />
    <meta name="yandex-verification" content="9025c19782f69056" />
    <meta name="seznam-wmt" content="1ESeV05G6tDEVk4A5GENuam0vaIKGQB0" />
    <meta name="naver-site-verification" content="3d451f63ff26eb3c9211fa7cc96ef9e8" />
    <meta name='Petal-Search-site-verification' content='bb96de33a2' />
    <meta name="norton-safeweb-site-verification"
        content="DMBBDQ2OR-GBN7SJK46P6POAAAQUW169OMI1DPXEWNKFBDNIX1QQJ1FPC-FYJ9G12H-OVWQ9EB64RDZKEWUIVNA1JZ-A4LN-KQ8ZBBQ0RQSRIPV08W27OFJ30SG2Z844" />
    <meta name="facebook-domain-verification" content="hebidzil1jjwb77svqxtbk5583euqi" />
    <meta name="google-adsense-account" content="ca-pub-7732927685285792">

    <link rel="dns-prefetch" href="https://fonts.googleapis.com" />
    <link rel="dns-prefetch" href="https://fonts.gstatic.com" />
    <link rel="dns-prefetch" href="https://res.cloudinary.com" />
    <link rel="dns-prefetch" href="https://www.google-analytics.com" />
    <link rel="dns-prefetch" href="https://connect.facebook.net" />
    <link rel="dns-prefetch" href="https://www.googletagmanager.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://res.cloudinary.com" />
    <link rel="preconnect" href="https://www.google-analytics.com" />
    <link rel="preconnect" href="https://connect.facebook.net" />
    <link rel="preconnect" href="https://www.googletagmanager.com" />

    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#ff2832" />
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#000000" />
    <meta name="mobile-web-app-capable" content="yes" />

    @include('frontend.blocks.seo')

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/color-01.css') }}">
    @yield('css')

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BQPM6WVTLQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-BQPM6WVTLQ');
    </script>
</head>

<body class="home-page">

    <noscript>You need to enable JavaScript to run this app.</noscript>

    @include('frontend.blocks.header')

    <main id="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    @include('frontend.blocks.footer')

    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "WebSite",
            "name": "{{ config('app.name') }}",
            "url": "{{ route('home') }}",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ route('home') }}/search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/", 
            "@type": "BreadcrumbList", 
            "itemListElement": [{
                "@type": "ListItem", 
                "position": 1, 
                "name": "Điện thoại Samsung",
                "item": "{{ route('home') }}/categories/samsung"  
            },{
                "@type": "ListItem", 
                "position": 2, 
                "name": "Điện thoại Apple",
                "item": "{{ route('home') }}/categories/apple"  
            },{
                "@type": "ListItem", 
                "position": 3, 
                "name": "Điện thoại Vivo",
                "item": "{{ route('home') }}/categories/vivo"  
            },{
                "@type": "ListItem", 
                "position": 4, 
                "name": "Điện thoại Xiaomi",
                "item": "{{ route('home') }}/categories/xiaomi"  
            },{
                "@type": "ListItem", 
                "position": 5, 
                "name": "Điện thoại Realme",
                "item": "{{ route('home') }}/categories/realme"  
            },{
                "@type": "ListItem", 
                "position": 6, 
                "name": "Điện thoại Nokia",
                "item": "{{ route('home') }}/categories/nokia"  
            }]
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "Cửa Hàng Điện Thoại Mobileworld",
            "image": "https://www.google.com/imgres?imgurl=https%3A%2F%2Fcdn.pixabay.com%2Fphoto%2F2015%2F04%2F23%2F22%2F00%2Ftree-736885_1280.jpg&tbnid=aVgXecnmQ_f1MM&vet=12ahUKEwjL7vfHhf2EAxWbbfUHHb-fCzEQMygCegQIARBP..i&imgrefurl=https%3A%2F%2Fpixabay.com%2Fimages%2Fsearch%2Fnature%2F&docid=Ba_eiczVaD9-zM&w=1280&h=797&q=image&ved=2ahUKEwjL7vfHhf2EAxWbbfUHHb-fCzEQMygCegQIARBP",
            "@id": "{{ route('home') }}",
            "url": "{{ route('home') }}",
            "telephone": "123456789",
            "priceRange": "1000-1000000000",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Hai Chau District",
                "addressLocality": "Da Nang City",
                "postalCode": "550000",
                "addressCountry": "VN"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 16.0601911,
                "longitude": 108.1706813
            },
            "openingHoursSpecification": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday"
                ],
                "opens": "00:00",
                "closes": "23:59"
            },
            "sameAs": [
                "{{ route('home') }}",
                "https://www.facebook.com/mobileworld",
                "https://www.twitter.com/mobileworld",
                "https://www.instagram.com/mobileworld",
                "https://www.youtube.com/@mobileworld",
                "https://www.linkedin.com/mobileworld",
                "https://www.pinterest.com/mobileworld"
            ] 
        }
    </script>
    @yield('schema-markup')

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
        $(document).ready(function() {
            var t = window.location.href.split("?")[0].replace("#", "").replace(/\/$/, ""),
                r = !1;
            $(".primary .menu-item").each(function(a) {
                $(this).children().first().attr("href") == t && ($(this).addClass("home-icon"), r = !0)
            }), r || $(".primary .menu-item").first().addClass("home-icon");
            var a = $("#back-to-top-btn");
            $(window).on("scroll", function() {
                $(this).scrollTop() > 100 ? a.css("transform", "translate3d(0px, 0, 0)") : a.css(
                    "transform", "translate3d(70px, 0, 0)")
            }), a.on("click", function(t) {
                $("html, body").animate({
                    scrollTop: 0
                }, 500)
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            var i = 0;
            $('input[name="q"]').keyup(function(e) {
                var s = $(this).val();
                if ($(".search-result-box").html(""), "" != s) {
                    let t = RegExp(s, "i");
                    i && clearTimeout(i), i = setTimeout(function() {
                        $.getJSON("/json/products.json", function(i) {
                            $.each(i, function(i, e) {
                                if (-1 != e.name.search(t)) {
                                    $(".search-result-box").css({
                                        opacity: 1,
                                        visibility: "visible"
                                    }).show();
                                    let s = e.price.toString().replace(
                                            /\B(?=(\d{3})+(?!\d))/g, "."),
                                        a = (e.price - e.discount).toString()
                                        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                    $(".search-result-box").append(
                                        '<li><a href="/product/' + e.slug +
                                        "-" + e.code +
                                        '"><div class="img-box"><img loading="lazy" src="' +
                                        e.featured_image + '" alt="' + e.name +
                                        '"></div><div class="info-box"><div class="info-title">' +
                                        e.name +
                                        '</div><div class="info-price">' + (0 ==
                                            e.discount ?
                                            '<div class="price-sale">' + s +
                                            "đ</div>" :
                                            '<div class="price-sale">' + a +
                                            'đ</div><div class="price-origins">' +
                                            s + "đ</div>") +
                                        "</div></div></a></li>")
                                }
                            })
                        })
                    }, 200)
                } else $(".search-result-box").css({
                    opacity: 0,
                    visibility: "hidden"
                }).html("")
            }), $(document).on("click", ".search-result-box li a", function(i) {
                i.preventDefault();
                let e = $(this).attr("href");
                $(this).closest(".search-result-box").html(""), location.href = e
            }), $(document).mouseup(function(i) {
                var e = $(".search-result-box");
                e.is(i.target) || 0 !== e.has(i.target).length || e.html("")
            })
        });
    </script>
    @yield('js')

</body>

</html>
