<meta charset="utf-8">
@if($global_page->meta('title'))
    <title>{{ $global_page->meta('title') }}</title>
@elseif($defaultpage->meta('title'))
    <title>{{ $defaultpage->meta('title') }}</title>
@endif
@if($global_page->meta('description'))
    <meta name="description" content="{{ $global_page->meta('description') }}">
@elseif($defaultpage->meta('robots'))
    <meta name="description" content="{{ $defaultpage->meta('description') }}">
@endif
@if($global_page->meta('keywords'))
    <meta name="keywords" content="{{ $global_page->meta('keywords') }}">
@elseif($defaultpage->meta('robots'))
    <meta name="keywords" content="{{ $defaultpage->meta('keywords') }}">
@endif
@if($global_page->meta('robots'))
    <meta name="robots" content="{{ $global_page->meta('robots') }}">
@elseif($defaultpage->meta('robots'))
    <meta name="robots" content="{{ $defaultpage->meta('robots') }}">
@endif
<meta name="author" content="JAMPstudio.pl">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
<!--Favicons -->
@include('frontend/parts/favicons') 

 <!--styles -->
 <link rel="stylesheet" type="text/css" href="/css/app.css{{ isset($VERSION) ? '?'.$VERSION : '' }}">

{{ $global_page->meta('head') }}