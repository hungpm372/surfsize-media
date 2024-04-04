@extends('frontend.layout.app')

@section('css')
    <style>
        .product-description {
            height: 500px;
            overflow: hidden;
            position: relative;
        }

        .product-description.expanded {
            height: auto;
            overflow: visible;
            transition: height 0.5s ease;
            padding-bottom: 30px;
        }

        .product-description img {
            width: 100%;
        }

        .fade-out {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 1));
            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        .fade-out.active {
            height: auto;
            background: none;
        }

        #gallery-container {
            display: none;
        }

        .product-gallery .slides .slide-item {
            position: relative;
        }

        .product-gallery .slides .slide-item.flex-active-slide::before {
            content: "\f002";
            font-family: FontAwesome;
            font-size: 23px;
            color: #de1c29;
            position: absolute;
            z-index: 0;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            opacity: 0;
            transition: all .2s ease;
        }

        .product-gallery .slides .slide-item.flex-active-slide:hover::before {
            opacity: 1;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-zoom.min.css">
@endsection


@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><a href="{{ route('category_products', ['slug' => $product->category->slug]) }}" class="link">điện thoại
                    {{ $product->category->name }}</a></li>
            <li class="item-link"><span>{{ $product->name }}</span></li>
        </ul>
    </div>

    <div id="gallery-container">
        @php
            $images = collect([$product->featured_image])->merge($product->productImages->pluck('name'));
        @endphp

        @foreach ($images as $image)
            <a class="gallery-item" data-src="{{ $image }}" data-sub-html="{{ $product->name }}">
                <img alt="{{ $product->name }}" class="img-responsive" src="{{ $image }}" loading="lazy" />
            </a>
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
            <div class="wrap-product-detail">
                <div class="detail-media">
                    <div class="product-gallery">
                        <ul class="slides">
                            @foreach ($images as $key => $image)
                                <li class="slide-item" data-thumb="{{ $image }}" data-thumb-id="{{ $key }}">
                                    <img src="{{ $image }}" alt="{{ $product->name }}" loading="lazy" class="mz-zoom" />
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="detail-info">
                    <div class="product-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <a href="#" class="count-review">(05 đánh giá)</a>
                    </div>
                    <h2 class="product-name">{{ $product->name }}</h2>
                    <div class="short-desc">
                        <ul>
                            <li class="mb-2"><b>Công nghệ màn hình: </b>{{ $product->screen_technology }}</li>
                            <li><b>Chip xử lý (CPU):</b> {{ $product->cpu }}</li>
                            <li><b>Camera trước:</b> {{ $product->front_camera }}</li>
                            <li><b>Camera sau:</b> {{ $product->rear_camera }}</li>
                            <li class="see-more"><b>Cấu hình chi tiết <i class="fa fa-cog" aria-hidden="true"></i></b></li>
                        </ul>
                    </div>
                    <div class="wrap-social">
                        <a class="link-socail" href="#"><img src="{{ asset('frontend/images/social-list.png') }}" alt=""></a>
                    </div>
                    <div class="wrap-price">
                        @if ($product->discount == 0)
                            <span class="product-price">{{ number_format($product->price, 0, '.', '.') }}đ</span>
                        @else
                            <span>
                                <p class="product-price">
                                    {{ number_format($product->price - $product->discount, 0, '.', '.') }}đ</p>
                            </span>
                            <del>
                                <p class="product-price">{{ number_format($product->price, 0, '.', '.') }}đ</p>
                            </del>
                        @endif
                    </div>
                    <div class="stock-info in-stock">
                        <p class="availability">Tình trạng: <b>{{ $product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}</b>
                        </p>
                    </div>
                    <div class="quantity">
                        <span>Số lượng:</span>
                        <div class="quantity-input">
                            <input type="text" name="product-quatity" value="1" data-max="{{ $product->quantity }}">

                            <a class="btn btn-reduce" href="#"></a>
                            <a class="btn btn-increase" href="#"></a>
                        </div>
                    </div>
                    <div class="wrap-butons">
                        @if ($product->quantity > 0)
                            <button data-price="{{ $product->price }}" data-url="{{ route('add_product_to_cart') }}" data-id="{{ $product->id }}"
                                class="btn btn-medium add-to-cart">thêm vào
                                giỏ hàng</button>
                        @else
                            <button type="button" disabled class="btn out-of-stock">hết hàng</button>
                        @endif
                        <div class="wrap-btn">
                            <button type="button" class="btn btn-compare btn-small btn-outline">so sánh</button>
                            <button type="button" class="btn btn-wishlist btn-small btn-outline">yêu thích</button>
                        </div>
                    </div>
                </div>
                <div class="advance-info">
                    <div class="tab-control normal">
                        <a href="#description" class="tab-control-item active">mô tả sản phẩm</a>
                        <a href="#add_infomation" id="see-more" class="tab-control-item">cấu hình chi tiết</a>
                        <a href="#review" class="tab-control-item">đánh giá</a>
                    </div>
                    <div class="tab-contents">
                        <div class="tab-content-item active" id="description">
                            <div class="product-description">
                                {!! $product->description !!}

                                <div class="fade-out">
                                    <button class="btn btn-small btn-outline toggle-description">Xem thêm</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content-item " id="add_infomation">
                            <table class="shop_attributes">
                                <tbody>
                                    <tr>
                                        <th>Công nghệ màn hình</th>
                                        <td>{{ $product->screen_technology }}</td>
                                    </tr>
                                    <tr>
                                        <th>Độ phân giải</th>
                                        <td>{{ $product->resolution }}</td>
                                    </tr>
                                    <tr>
                                        <th>Camera trước</th>
                                        <td>{{ $product->front_camera }}</td>
                                    </tr>
                                    <tr>
                                        <th>Camera sau</th>
                                        <td>{{ $product->rear_camera }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hệ điều hành</th>
                                        <td>{{ $product->os }}</td>
                                    </tr>
                                    <tr>
                                        <th>Chip xử lý (CPU)</th>
                                        <td>{{ $product->cpu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bộ nhớ trong (ROM)</th>
                                        <td>{{ $product->rom }}</td>
                                    </tr>
                                    <tr>
                                        <th>RAM</th>
                                        <td>{{ $product->ram }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sim</th>
                                        <td>{{ $product->sim }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dung lượng pin/Sạc</th>
                                        <td>{{ $product->pin }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-content-item " id="review">

                            <div class="wrap-review-form">

                                <div id="comments">
                                    <h2 class="woocommerce-Reviews-title">01 review for <span>Radiant-360 R6 Chainsaw
                                            Omnidirectional [Orage]</span></h2>
                                    <ol class="commentlist">
                                        <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
                                            <div id="comment-20" class="comment_container">
                                                <img alt="" src="{{ asset('assets/7b0f8a91e7d3ac38e85856e69b7a16c1.png') }}" height="80" width="80">
                                                <div class="comment-text">
                                                    <div class="star-rating">
                                                        <span class="width-80-percent">Rated <strong class="rating">5</strong> out of 5</span>
                                                    </div>
                                                    <p class="meta">
                                                        <strong class="woocommerce-review__author">admin</strong>
                                                        <span class="woocommerce-review__dash">–</span>
                                                        <time class="woocommerce-review__published-date" datetime="2008-02-14 20:00">Tue, Aug 15, 2017</time>
                                                    </p>
                                                    <div class="description">
                                                        <p>Pellentesque habitant morbi tristique senectus et netus et
                                                            malesuada fames ac turpis egestas.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div><!-- #comments -->

                                <div id="review_form_wrapper">
                                    <div id="review_form">
                                        <div id="respond" class="comment-respond">

                                            <form action="#" method="post" id="commentform" class="comment-form" novalidate="">
                                                <p class="comment-notes">
                                                    <span id="email-notes">Your email address will not be published.</span>
                                                    Required fields are marked <span class="required">*</span>
                                                </p>
                                                <div class="comment-form-rating">
                                                    <span>Your rating</span>
                                                    <p class="stars">

                                                        <label for="rated-1"></label>
                                                        <input type="radio" id="rated-1" name="rating" value="1">
                                                        <label for="rated-2"></label>
                                                        <input type="radio" id="rated-2" name="rating" value="2">
                                                        <label for="rated-3"></label>
                                                        <input type="radio" id="rated-3" name="rating" value="3">
                                                        <label for="rated-4"></label>
                                                        <input type="radio" id="rated-4" name="rating" value="4">
                                                        <label for="rated-5"></label>
                                                        <input type="radio" id="rated-5" name="rating" value="5" checked="checked">
                                                    </p>
                                                </div>
                                                <p class="comment-form-author">
                                                    <label for="author">Name <span class="required">*</span></label>
                                                    <input id="author" name="author" type="text" value="">
                                                </p>
                                                <p class="comment-form-email">
                                                    <label for="email">Email <span class="required">*</span></label>
                                                    <input id="email" name="email" type="email" value="">
                                                </p>
                                                <p class="comment-form-comment">
                                                    <label for="comment">Your review <span class="required">*</span>
                                                    </label>
                                                    <textarea id="comment" name="comment" cols="45" rows="8"></textarea>
                                                </p>
                                                <p class="form-submit">
                                                    <button type="submit" id="submit" class="submit btn btn-small px-35">Gửi</button>
                                                </p>
                                            </form>

                                        </div><!-- .comment-respond-->
                                    </div><!-- #review_form -->
                                </div><!-- #review_form_wrapper -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end main products area-->

        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
            <div class="widget widget-our-services ">
                <div class="widget-content">
                    <ul class="our-services">

                        <li class="service">
                            <div class="link-to-service">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                                <div class="right-content">
                                    <b class="title">miễn phí vận chuyển</b>
                                    <span class="subtitle">đơn hàng trên 3 triệu</span>
                                </div>
                            </div>
                        </li>

                        <li class="service">
                            <div class="link-to-service">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                <div class="right-content">
                                    <b class="title">quà tặng đặc biệt</b>
                                    <span class="subtitle">nhận một món quà!</span>
                                </div>
                            </div>
                        </li>

                        <li class="service">
                            <div class="link-to-service">
                                <i class="fa fa-reply" aria-hidden="true"></i>
                                <div class="right-content">
                                    <b class="title">chính sách hoàn trả</b>
                                    <span class="subtitle">đổi trả trong vòng 7 ngày</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div><!-- Categories widget-->

            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">sản phẩm phổ biến</h2>
                <div class="widget-content">
                    <ul class="products">

                        @foreach ($popularProducts as $item)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}" title="{{ $item->name }}">
                                            <figure><img src="{{ $item->featured_image }}" alt="{{ $item->name }}" loading="lazy">
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                            class="product-name"><span>{{ $item->name }}</span></a>
                                        <div class="wrap-price">
                                            @if ($item->discount == 0)
                                                <span class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</span>
                                            @else
                                                <span>
                                                    <p class="product-price">
                                                        {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ
                                                    </p>
                                                </span>
                                                <del>
                                                    <p class="product-price">
                                                        {{ number_format($item->price, 0, '.', '.') }}đ</p>
                                                </del>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>

        </div>
        <!--end sitebar-->

        <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h2 class="title-box">sản phẩm liên quan</h2>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="true" data-slideSpeed="1000" data-autoplay="true"
                        data-autoplayTimeout="5000" data-nav="true" data-dots="false" data-margin="10"
                        data-responsive='{"0":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
                        @foreach ($relatedProducts as $item)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}" title="{{ $item->name }}">
                                        <figure><img src="{{ $item->featured_image }}" width="214" height="214" alt="{{ $item->name }}" loading="lazy">
                                        </figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item sale-label">sale</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}" class="function-link">quick
                                            view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}" class="product-name">
                                        <span>{{ $item->name }}</span>
                                    </a>
                                    <div class="wrap-price">
                                        @if ($item->discount == 0)
                                            <span class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</span>
                                        @else
                                            <span>
                                                <p class="product-price">
                                                    {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</p>
                                            </span>
                                            <del>
                                                <p class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ
                                                </p>
                                            </del>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!--End wrap-products-->
            </div>
        </div>

    </div>
    <!--end row-->
@endsection


@section('js')
    <script>
        $(document).ready(function() {
            $(".see-more").on("click", function() {
                $("#see-more").click(), $("html, body").animate({
                    scrollTop: $("#see-more").offset().top - 80
                })
            }), $(".toggle-description").click(function() {
                var e = $(".product-description");
                e.toggleClass("expanded");
                var t = e.hasClass("expanded");
                $(this).text(t ? "Thu gọn" : "Xem th\xeam").parent().toggleClass("active")
            })
        });
    </script>

    <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('frontend/js/add-to-cart.js') }}"></script>
    <script src="{{ asset('frontend/js/zoom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/zoom/lg-zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script>
        $(function() {
            if (!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))) {
                $('.mz-zoom').each(function() {
                    $(this).extm();
                })
            }
        });
    </script>
    <script>
        $(function() {
            if (window.lightGallery) {
                var plugin = lightGallery(document.getElementById('gallery-container'), {
                    plugins: [lgZoom, lgThumbnail],
                    speed: 500,
                    mode: 'lg-slide',
                    thumbnail: true,
                    autoplayFirstVideo: false,
                    pager: false,
                    galleryId: "nature",
                    plugins: [lgZoom, lgThumbnail],
                    mobileSettings: {
                        controls: false,
                        showCloseIcon: false,
                        download: false,
                        rotate: false
                    },
                    hideBarsDelay: 3000,
                    closeOnTap: false,
                    showZoomInOutIcons: true,
                    actualSize: false,
                    addClass: 'gallery-container'
                });

                plugin.closeGallery();

                $(document).on('click', '.product-gallery .slides li.flex-active-slide', function() {
                    var _this = $(this)
                    var indexSelected = _this.data('thumb-id')
                    plugin.openGallery(indexSelected)
                })
            }
        })
    </script>
@endsection
