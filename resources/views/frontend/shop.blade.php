@extends('frontend.layout.app')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{ route('home') }}" class="link">trang chủ</a></li>
            <li class="item-link"><span>{{ $title }}</span></li>
        </ul>
    </div>
    <div class="row main-site left-sidebar">

        {{-- right content --}}
        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
            <div class="wrap-shop-control">

                <h1 class="shop-title">điện thoại {{ $title }}</h1>

                <div class="wrap-right">

                    <div class="sort-item orderby ">
                        {{-- <select name="orderby" class="use-chosen">
                            <option value="menu_order" selected="selected">Mặc định</option>
                            <option value="popularity">Mới nhất</option>
                            <option value="rating">Được yêu thích nhất</option>
                            <option value="date">Được xem nhiều nhất</option>
                            <option value="price">Giá: thấp đến cao</option>
                            <option value="price-desc">Giá: cao đến thấp</option>
                        </select> --}}
                        <div class="select-container">
                            <a class="select-label">Sắp xếp theo<i class="fa fa-angle-down"></i></a>
                            <div class="select-drop">
                                <ul>
                                    <li><a href="{{ route('category_products', ['slug' => $slug, 'sort_by' => 'default']) }}">Mặc
                                            định</a>
                                    </li>
                                    <li><a href="{{ route('category_products', ['slug' => $slug, 'sort_by' => 'latest']) }}">Mới
                                            nhất</a>
                                    </li>
                                    <li><a href="{{ route('category_products', ['slug' => $slug, 'sort_by' => 'favourite']) }}">Được
                                            yêu
                                            thích
                                            nhất</a>
                                    </li>
                                    <li><a href="{{ route('category_products', ['slug' => $slug, 'sort_by' => 'view']) }}">Được
                                            xem
                                            nhiều
                                            nhất</a>
                                    </li>
                                    <li><a href="{{ route('category_products', ['slug' => $slug, 'sort_by' => 'price', 'sort_order' => 'asc']) }}">Giá:
                                            thấp
                                            đến cao</a>
                                    </li>
                                    <li><a href="{{ route('category_products', ['slug' => $slug, 'sort_by' => 'price', 'sort_order' => 'desc']) }}">Giá:
                                            cao
                                            đến
                                            thấp</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="sort-item product-per-page">
                        <select name="post-per-page" class="use-chosen">
                            <option value="12" selected="selected">12 per page</option>
                            <option value="16">16 per page</option>
                            <option value="18">18 per page</option>
                            <option value="21">21 per page</option>
                            <option value="24">24 per page</option>
                            <option value="30">30 per page</option>
                            <option value="32">32 per page</option>
                        </select>
                    </div> --}}

                </div>

            </div>
            <div class="product-list-container">
                <div class="row">
                    <ul class="product-list grid-products equal-container">
                        @forelse ($products as $item)
                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}" title="{{ $item->name }}">
                                            <figure><img src="{{ $item->featured_image }}" alt="{{ $item->name }}" loading="lazy"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                            class="product-name"><span>{{ $item->name }}</span></a>
                                        <div class="wrap-price">
                                            @if ($item->discount == 0)
                                                <span>
                                                    <p class="product-price">
                                                        {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</p>
                                                </span>
                                                <del>
                                                    <p class="product-price" style="visibility: hidden;">
                                                        {{ number_format($item->price, 0, '.', '.') }}đ
                                                    </p>
                                                </del>
                                            @else
                                                <span>
                                                    <p class="product-price">
                                                        {{ number_format($item->price - $item->discount, 0, '.', '.') }}đ</p>
                                                </span>
                                                <del>
                                                    <p class="product-price">
                                                        {{ number_format($item->price, 0, '.', '.') }}đ
                                                    </p>
                                                </del>
                                            @endif
                                        </div>
                                        <a href="#" data-price="{{ $item->price }}" data-url="{{ route('add_product_to_cart') }}" data-id="{{ $item->id }}"
                                            class="btn add-to-cart btn-small">thêm vào giỏ hàng</a>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="product-not-found">
                                    <div class="product-not-found-img">
                                        <img src="{{ asset('frontend/images/app/product-not-nound.png') }}" alt="">
                                    </div>
                                    <div class="product-not-found-message">
                                        <p>Không tìm thấy sản phẩm phù hợp!</p>
                                    </div>
                                </div>
                            </li>
                        @endforelse

                    </ul>

                </div>
            </div>


            <div class="wrap-pagination-info">
                <ul class="page-numbers">
                    <li><span class="page-number-item current">1</span></li>
                    <li><a class="page-number-item" href="#">2</a></li>
                    <li><a class="page-number-item" href="#">3</a></li>
                    <li><a class="page-number-item" href="#">4</a></li>
                    {{-- <li><a class="page-number-item next-link" href="#">4</a></li> --}}
                </ul>
                {{-- <p class="result-count">Showing 1-8 of 12 result</p> --}}
            </div>
        </div>

        {{-- left sidebar --}}
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
            <div class="widget mercado-widget categories-widget">
                <h2 class="widget-title">tất cả danh mục</h2>
                <div class="widget-content">
                    <ul class="list-category">
                        {{-- <li class="category-item has-child-cate">
                            <a href="#" class="cate-link">Fashion & Accessories</a>
                            <span class="toggle-control">+</span>
                            <ul class="sub-cate">
                                <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a></li>
                                <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                                <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                            </ul>
                        </li>
                        <li class="category-item has-child-cate">
                            <a href="#" class="cate-link">Furnitures & Home Decors</a>
                            <span class="toggle-control">+</span>
                            <ul class="sub-cate">
                                <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a></li>
                                <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                                <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                            </ul>
                        </li>
                        <li class="category-item has-child-cate">
                            <a href="#" class="cate-link">Digital & Electronics</a>
                            <span class="toggle-control">+</span>
                            <ul class="sub-cate">
                                <li class="category-item"><a href="#" class="cate-link">Batteries (22)</a></li>
                                <li class="category-item"><a href="#" class="cate-link">Headsets (16)</a></li>
                                <li class="category-item"><a href="#" class="cate-link">Screen (28)</a></li>
                            </ul>
                        </li>
                        <li class="category-item">
                            <a href="#" class="cate-link">Tools & Equipments</a>
                        </li>
                        <li class="category-item">
                            <a href="#" class="cate-link">Kid’s Toys</a>
                        </li> --}}
                        @foreach ($categories as $item)
                            <li class="category-item">
                                <a href="{{ route('category_products', ['slug' => $item->slug]) }}"
                                    class="cate-link {{ $title == $item->name ? 'active' : '' }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- Categories widget-->

            {{-- <div class="widget mercado-widget filter-widget brand-widget">
                <h2 class="widget-title">tất cả danh mục</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list list-limited" data-show="6">
                        @foreach ($categories as $item)
                            <li class="list-item"><a class="filter-link"
                                    href="{{ route('category_products', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach

                        {{-- <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
                        <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
                        <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a>
                        </li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a>
                        </li>
                        <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone &
                                Tablets</a></li>
                        <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>'
                                class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down"
                                    aria-hidden="true"></i></a></li> 
                    </ul>
                </div>
            </div><!-- brand widget--> --}}

            <div class="widget mercado-widget filter-widget price-filter">
                <h2 class="widget-title">Mức giá</h2>
                <div class="widget-content">
                    <div id="slider-range"></div>
                    <p class="wrap-filter">
                        <input type="text" id="amount" readonly>
                        <button class="btn filter-submit btn-xs" data-min="0" data-max="100000000">Lọc</button>
                    </p>
                </div>
            </div><!-- Price-->

            <div class="widget mercado-widget filter-widget">
                <h2 class="widget-title">Màu sắc</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list has-count-index">
                        @foreach ($colorLists as $item)
                            <li class="list-item"><a class="filter-link">{{ $item }} <span>(217)</span></a></li>
                        @endforeach
                    </ul>
                </div>
            </div><!-- Color -->

            <div class="widget mercado-widget widget-product">
                <h2 class="widget-title">sản phẩm phổ biến</h2>
                <div class="widget-content">
                    <ul class="products">
                        @foreach ($popularProducts as $item)
                            <li class="product-item">
                                <div class="product product-widget-style">
                                    <div class="thumbnnail">
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}" title="{{ $item->name }}">
                                            <figure><img src="{{ $item->featured_image }}" alt="{{ $item->name }}" loading="lazy"></figure>
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
            </div><!-- brand widget-->

        </div>

    </div>
@endsection

@section('js')
    <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name="orderby"]').on('change', function() {
                alert('Order')
            })


            $('.btn.filter-submit').on('click', function() {

                // history.pushState(null, null, window.location.href + '?a=5');
                var min = $(this).data('min');
                var max = $(this).data('max');
                // Lưu giá trị của hai tham số

                // Lấy URL hiện tại
                var url = window.location.href;

                // Kiểm tra xem các tham số đã có trong URL chưa
                if (url.indexOf('?') === -1) {
                    // Nếu chưa có, thêm tham số vào URL
                    url += '?min=' + min + '&max=' + max;
                } else {
                    // Nếu đã có, thay thế giá trị của tham số trong URL
                    var regex = new RegExp('([?&]' + encodeURIComponent('min') + '=)[^&]+');
                    if (regex.test(url)) {
                        url = url.replace(regex, '$1' + encodeURIComponent(min));
                    } else {
                        url += '&min=' + min;
                    }

                    regex = new RegExp('([?&]' + encodeURIComponent('max') + '=)[^&]+');
                    if (regex.test(url)) {
                        url = url.replace(regex, '$1' + encodeURIComponent(max));
                    } else {
                        url += '&max=' + max;
                    }
                }
                history.pushState(null, null, url);
                // const searchParams = new URLSearchParams(window.location.search);
                // const a = searchParams.get('a');
                // console.log(a);
                $.ajax({
                    url: '/ajax/categories/filter',
                    data: {
                        // _token: $('meta[name="csrf-token"]').attr('content'),
                        min: min,
                        max: max
                    },
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // var productList = document.querySelector('ul.product-list');
                        // productList.innerHTML = ""
                        // response.forEach(function(product) {
                        //     // Tạo một phần tử li để chứa thông tin sản phẩm
                        //     var li = document.createElement('li');
                        //     li.classList.add('col-lg-4', 'col-md-6', 'col-sm-6',
                        //         'col-xs-6');

                        //     // Tạo HTML cho sản phẩm
                        //     var html =
                        //         '<div class="product product-style-3 equal-elem">';
                        //     html += '<div class="product-thumnail">';
                        //     html += '<a href="/product/' + product.slug + '-' + product
                        //         .code + '" title="' + product.name + '">';
                        //     html += '<figure><img src="/storage/products/' + product
                        //         .featured_image + '" alt="' + product.name +
                        //         '"></figure>';
                        //     html += '</a>';
                        //     html += '</div>';
                        //     html += '<div class="product-info">';
                        //     html += '<a href="/product/' + product.slug + '-' + product
                        //         .code + '" class="product-name"><span>' + product.name +
                        //         '</span></a>';
                        //     html +=
                        //         '<div class="wrap-price"><span class="product-price">' +
                        //         product.price + '</span></div>';
                        //     html += '<a href="#" data-price="' + product.price +
                        //         '" data-url="/cart/add-product-to-cart" data-id="' +
                        //         product.id +
                        //         '" class="btn add-to-cart">thêm vào giỏ hàng</a>';
                        //     html += '</div>';
                        //     html += '</div>';

                        //     // Thêm HTML của sản phẩm vào phần tử li
                        //     li.innerHTML = html;

                        //     // Thêm phần tử li vào danh sách sản phẩm
                        //     productList.appendChild(li);
                        // });
                        var productList = $('ul.product-list');
                        productList.empty();
                        $.each(response, function(index, product) {
                            // Tạo một phần tử li để chứa thông tin sản phẩm
                            var li = $('<li>')
                                .addClass('col-lg-4 col-md-6 col-sm-6 col-xs-6');

                            // Tạo HTML cho sản phẩm
                            var html =
                                '<div class="product product-style-2 equal-elem">';
                            html += '<div class="product-thumnail">';
                            html += '<a href="/product/' + product.slug + '-' + product
                                .code + '" title="' + product.name + '">';
                            html += '<figure><img src="' + product
                                .featured_image + '" alt="' + product.name +
                                '"></figure>';
                            html += '</a>';
                            html += '</div>';
                            html += '<div class="product-info">';
                            html += '<a href="/product/' + product.slug + '-' + product
                                .code + '" class="product-name"><span>' + product.name +
                                '</span></a>';
                            html +=
                                '<div class="wrap-price"><span class="product-price">' +
                                Number(product.price).toLocaleString('vi-VN') + 'đ</span></div>';
                            html += '<a href="#" data-price="' + Number(product.price).toLocaleString('vi-VN') +
                                '" data-url="/cart/add-product-to-cart" data-id="' +
                                product.id +
                                '" class="btn add-to-cart btn-small">thêm vào giỏ hàng</a>';
                            html += '</div>';
                            html += '</div>';

                            // Thêm HTML của sản phẩm vào phần tử li
                            li.html(html);
                            li.hide().appendTo(productList).delay(100 * index).fadeIn();
                        });
                    },
                    error: function(xhr, status, error) {}
                });
            })
        });
    </script>
    <script src="{{ asset('frontend/js/add-to-cart.js') }}"></script>
@endsection
