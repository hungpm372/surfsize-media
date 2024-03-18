{{-- {{ dd($seo) }} --}}
<title>{{ mb_convert_case('Mobileworld | ' . $seo['title'], MB_CASE_TITLE, 'UTF-8') }}</title>
<meta name="title" content="{{ mb_convert_case('Mobileworld | ' . $seo['title'], MB_CASE_TITLE, 'UTF-8') }}" />
<meta name="description" content="{{ $seo['description'] }}" />
<meta name="keywords" content="{{ $keywords ?? 'Từ khóa mặc định' }}" />
<meta name="language" content="Vietnamese" />
<meta name="author" content="Phan Minh Hung" />
<meta name="robots" content="index, follow" />

<meta property="og:type" content="website" />
<meta property="og:url" content="{{ request()->url() }}" />
<meta property="og:title" content="{{ mb_convert_case('Mobileworld | ' . $seo['title'], MB_CASE_TITLE, 'UTF-8') }}" />
<meta property="og:description" content="{{ $seo['description'] }}" />
<meta property="og:image" content="{{ $seo['image'] ?? 'http://127.0.0.1:8000/storage/app/slider1.jpg' }}" />
<meta property="og:locale" content="vi_VN" />
<meta property="og:site_name" content="Mobileworld" />
<meta property="fb:app_id" content="2108579366179393" />

<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{ request()->url() }}" />
<meta property="twitter:title" content="{{ mb_convert_case('Mobileworld | ' . $seo['title'], MB_CASE_TITLE, 'UTF-8') }}" />
<meta property="twitter:description" content="{{ $seo['description'] }}" />
<meta property="twitter:image" content="{{ $seo['image'] ?? 'http://127.0.0.1:8000/storage/app/slider1.jpg' }}" />
<meta property="twitter:image:alt" content="{{ $seo['alt'] ?? mb_convert_case('Mobileworld | ' . $seo['title'], MB_CASE_TITLE, 'UTF-8') }}" />
<meta property="twitter:site:id" content="1245893597859213312" />
<meta property="twitter:site" content="&#64;mobileworld" />
<meta property="twitter:creator" content="&#64;hungpm372" />

<meta name="DC.title" content="{{ mb_convert_case('Mobileworld | ' . $seo['title'], MB_CASE_TITLE, 'UTF-8') }}" />
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="Da Nang" />
<meta name="geo.position" content="15.926666;107.965086" />
<meta name="ICBM" content="15.926666, 107.965086" />

<link rel="canonical" href="{{ $seo['canonical'] ?? request()->url() }}" />
