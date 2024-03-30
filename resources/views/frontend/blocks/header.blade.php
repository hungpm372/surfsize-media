<div class="mercado-clone-wrap">
    <div class="mercado-panels-actions-wrap">
        <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
    </div>
    <div class="mercado-panels"></div>
</div>

<header id="header" class="header header-style-1">
    <div class="container-fluid">
        <div class="row">
            <div class="topbar-menu-area">
                <div class="container">
                    <div class="topbar-menu left-menu">
                        <ul>
                            <li class="menu-item">
                                <a title="Hotline: (+123) 456 789" href="tel:(+123) 456 789"><span class="icon label-before fa fa-mobile"></span>Hotline: (+123) 456 789</a>
                            </li>
                        </ul>
                    </div>
                    <div class="topbar-menu right-menu">
                        <ul>
                            <li class="menu-item menu-item-has-children parent">
                                <a href="">Tiếng Việt<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="submenu curency">
                                    <li class="menu-item">
                                        <a title="Tiếng Việt" href="{{ route('order') }}">Tiếng Việt</a>
                                    </li>
                                    <li class="menu-item">
                                        <a title="English" href="{{ route('logout') }}">English</a>
                                    </li>
                                </ul>
                            </li>
                            @if (Auth::check())
                                <li class="menu-item menu-item-has-children parent">
                                    <a href="">{{ Auth::user()->name }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                    <ul class="submenu curency">
                                        <li class="menu-item">
                                            <a title="Tài khoản của tôi" href="{{ route('user', ['id' => 1]) }}">tài
                                                khoản
                                                của tôi</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Đơn hàng" href="{{ route('order') }}">đơn hàng</a>
                                        </li>
                                        <li class="menu-item">
                                            <a title="Đăng xuất" href="{{ route('logout') }}">đăng xuất</a>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="menu-item"><a href="{{ route('login') }}">đăng nhập</a>
                                </li>
                                <li class="menu-item"><a href="{{ route('register') }}">đăng ký</a>
                                </li>
                            @endif

                            <li class="menu-item"><a href="{{ route('about_us') }}">về chúng tôi</a>
                            </li>
                            <li class="menu-item"><a href="{{ route('contact_us') }}">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="main-header">
                <div class="container">
                    <div class="mid-section main-info-area">

                        <div class="wrap-logo-top left-section">
                            <a href="{{ route('home') }}" class="link-to-home">
                                <h1 class="logo">{{ Config::get('app.name') }}</h1>
                            </a>
                        </div>

                        <div class="wrap-search center-section">
                            <div class="wrap-search-form">
                                <form action="{{ route('search') }}" id="form-search-top" name="form-search-top">
                                    <input type="text" name="q" value="{{ $keyword ?? '' }}" placeholder="Tìm kiếm sản phẩm tại đây..." autocomplete="off">
                                    <button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                    <div class="search-result-box">
                                    </div>

                                    <div class="wrap-list-cate">
                                        <a href="javascript:" class="link-control">Tất cả danh mục</a>
                                        <ul class="list-cate">
                                            @foreach ($categories as $item)
                                                <li class="level-1">{{ $item->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="wrap-icon right-section">
                            <div class="wrap-icon-section wishlist">
                                {{-- <div class="wrap-icon-section minicart"> --}}
                                <a href="#" class="link-direction">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <div class="left-info">
                                        <span class="index">0</span>
                                    </div>
                                </a>
                            </div>
                            <div class="wrap-icon-section minicart">
                                <a href="{{ route('cart') }}" class="link-direction">
                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                    <div class="left-info">
                                        <span class="index product-quantity">{{ $productQuantities }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="nav-section header-sticky">
                <div class="primary-nav-section">
                    <div class="container">
                        <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
                            {{-- <li class="menu-item">
                                <a href="{{ route('home') }}" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                            </li> --}}
                            @foreach ($categories as $item)
                                <li class="menu-item">
                                    <a href="{{ route('category_products', ['slug' => $item->slug]) }}" class="link-term mercado-item-title">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
