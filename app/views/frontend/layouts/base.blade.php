<?php 
    $defaultpage = Page::byTag('default');
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
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
     <link rel="stylesheet" type="text/css" href="/css/app.css">

    <!-- base scripts -->
    <script src="/bower_components/jquery/jquery.min.js"></script>
    <script src="/bower_components/modernizr/modernizr.js"></script>

    <!-- The HTML5 shiv, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
    <!-- js trans -->
    <script src="/js/trans/{{\Config::get('app.locale')}}.js"></script>
    
    {{ $global_page->meta('head') }}
</head>
<body>

@yield('main')

@section('scripts')
    <script src="/bower_components/imgLiquid/js/imgLiquid-min.js"></script>
    <script src="/frontend/js/forms.js"></script>
    <script src="/js/trans/{{\Config::get('app.locale')}}.js"></script>
    <script src="/js/app.js"></script>

@show

{{ $global_page->meta('footer') }}
</body>
</html>