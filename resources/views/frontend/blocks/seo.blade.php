<title>{{ $seo['title'] }}</title>
<meta name="title" content="{{ $seo['title'] }}" />
<meta name="description" content="{{ $seo['description'] }}" />
<meta name="keywords" content="{{ $seo['keywords'] }}" />
<meta name="language" content="Vietnamese" />
<meta name="author" content="Phan Minh Hung" />
<meta name="copyright" content="Phan Minh Hung" />
<meta name="robots" content="index, follow" />

<meta property="og:type" content="website" />
<meta property="og:url" content="{{ request()->url() }}" />
<meta property="og:title" content="{{ $seo['title'] }}" />
<meta property="og:description" content="{{ $seo['description'] }}" />
<meta property="og:image" content="{{ $seo['image'] ?? asset('assets/7b0f8a91e7d3ac38e85856e69b7a16c1.png') }}" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:site_name" content="{{ Config::get('app.name') }}" />
<meta property="fb:app_id" content="2108579366179393" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:url" content="{{ request()->url() }}" />
<meta name="twitter:title" content="{{ $seo['title'] }}" />
<meta name="twitter:description" content="{{ $seo['description'] }}" />
<meta name="twitter:image" content="{{ $seo['image'] ?? asset('assets/7b0f8a91e7d3ac38e85856e69b7a16c1.png') }}" />
<meta name="twitter:image:alt" content="{{ $seo['title'] }}" />
<meta name="twitter:site:id" content="1245893597859213312" />
<meta name="twitter:site" content="&#64;mobileworld" />
<meta name="twitter:creator" content="&#64;hungpm372" />

<meta name="DC.title" content="{{ $seo['title'] }}" />
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="Da Nang" />
<meta name="geo.position" content="15.926666;107.965086" />
<meta name="ICBM" content="15.926666, 107.965086" />

<link rel="canonical" href="{{ $seo['canonical'] ?? request()->url() }}" />
