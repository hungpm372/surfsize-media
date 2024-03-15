@extends('frontend.layout.app')

@section('title')
    {{ mb_convert_case($title, MB_CASE_TITLE, 'UTF-8') }}
@endsection


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

                <h1 class="shop-title">kết quả tìm kiếm cho từ khóa '<span
                        style="text-transform: none">{{ $keyword }}</span>'
                </h1>

                <div class="wrap-right">

                    <div class="sort-item orderby ">
                        <select name="orderby" class="use-chosen">
                            <option value="menu_order" selected="selected">Mặc định</option>
                            <option value="popularity">Mới nhất</option>
                            <option value="rating">Được yêu thích nhất</option>
                            <option value="date">Được xem nhiều nhất</option>
                            <option value="price">Giá: thấp đến cao</option>
                            <option value="price-desc">Giá: cao đến thấp</option>
                        </select>
                    </div>

                    <div class="sort-item product-per-page">
                        <select name="post-per-page" class="use-chosen">
                            <option value="12" selected="selected">12 per page</option>
                            <option value="16">16 per page</option>
                            <option value="18">18 per page</option>
                            <option value="21">21 per page</option>
                            <option value="24">24 per page</option>
                            <option value="30">30 per page</option>
                            <option value="32">32 per page</option>
                        </select>
                    </div>

                    {{-- <div class="change-display-mode">
                        <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                        <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                    </div> --}}

                </div>

            </div>
            <!--end wrap shop control-->

            <div class="row">

                <ul class="product-list grid-products equal-container">
                    @forelse ($products as $item)
                        <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                            <div class="product product-style-3 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                        title="{{ $item->name }}">
                                        <figure><img src="{{ $item->featured_image }}" alt="{{ $item->name }}"
                                                loading="lazy"></figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                        class="product-name"><span>{{ $item->name }}</span></a>
                                    <div class="wrap-price">
                                        @if ($item->discount == 0)
                                            <span
                                                class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</span>
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
                                    <a href="#" data-price="{{ $item->price }}"
                                        data-url="{{ route('add_product_to_cart') }}" data-id="{{ $item->id }}"
                                        class="btn add-to-cart">thêm vào giỏ hàng</a>
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

            <div class="wrap-pagination-info">
                <ul class="page-numbers">
                    <li><span class="page-number-item current">1</span></li>
                    <li><a class="page-number-item" href="#">2</a></li>
                    <li><a class="page-number-item" href="#">3</a></li>
                    <li><a class="page-number-item next-link" href="#">Next</a></li>
                </ul>
                <p class="result-count">Showing 1-8 of 12 result</p>
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
                <h2 class="widget-title">Price</h2>
                <div class="widget-content">
                    <div id="slider-range"></div>
                    <p>
                        <label for="amount">Price:</label>
                        <input type="text" id="amount" readonly>
                        <button class="filter-submit">Filter</button>
                    </p>
                </div>
            </div><!-- Price-->

            <div class="widget mercado-widget filter-widget">
                <h2 class="widget-title">Màu sắc</h2>
                <div class="widget-content">
                    <ul class="list-style vertical-list has-count-index">
                        <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
                        <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
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
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                            title="{{ $item->name }}">
                                            <figure><img src="{{ $item->featured_image }}" alt="{{ $item->name }}"
                                                    loading="lazy"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ route('product_detail', ['slug' => $item->slug, 'code' => $item->code]) }}"
                                            class="product-name"><span>{{ $item->name }}</span></a>
                                        <div class="wrap-price">
                                            @if ($item->discount == 0)
                                                <span
                                                    class="product-price">{{ number_format($item->price, 0, '.', '.') }}đ</span>
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
    <script src="{{ asset('frontend/js/add-to-cart.js') }}"></script>
@endsection
