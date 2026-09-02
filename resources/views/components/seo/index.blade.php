@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'type' => 'website',
    'author' => null,
    'publishedTime' => null,
    'modifiedTime' => null,
    'noindex' => false,
])

@php
    $locale = app()->getLocale();
    $currentUrl = url()->current();
    $siteName = company('name');
    $defaultTitle = __('ui.home') . ' — ' . $siteName;
    $pageTitle = $title ? $title . ' — ' . $siteName : $defaultTitle;
    $metaDesc = $description ?? __('ui.meta.description');
    $metaKeywords = $keywords ?? __('ui.meta.keywords');
    $ogImage = $image ?? asset('images/logo/hero-logo.png');
    $canonical = url()->current();
@endphp

<title>{{ $pageTitle }}</title>

<!-- Primary Meta -->
<meta name="description" content="{{ $metaDesc }}">
@if($metaKeywords)
<meta name="keywords" content="{{ $metaKeywords }}">
@endif
<meta name="robots" content="{{ $noindex ? 'noindex, nofollow' : 'index, follow' }}">
<link rel="canonical" href="{{ $canonical }}">

<!-- Open Graph -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $metaDesc }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:url" content="{{ $currentUrl }}">
<meta property="og:locale" content="{{ $locale === 'id' ? 'id_ID' : 'en_US' }}">
@if($publishedTime)
<meta property="article:published_time" content="{{ $publishedTime }}">
@endif
@if($modifiedTime)
<meta property="article:modified_time" content="{{ $modifiedTime }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $metaDesc }}">
<meta name="twitter:image" content="{{ $ogImage }}">
@if($author)
<meta name="author" content="{{ $author }}">
@endif
