<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>{{ \Config::get('backend.template.meta_title') }}</title>

        <meta name="description" content="{{ \Config::get('backend.template.description') }}">
        <meta name="author" content="{{ \Config::get('backend.template.author') }}">
        <meta name="robots" content="{{ \Config::get('backend.template.robots') }}">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="/backend/img/favicon.png">
        <link rel="apple-touch-icon" href="/backend/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="/backend/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="/backend/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="/backend/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="/backend/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="/backend/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="/backend/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="/backend/img/icon180.png" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="/backend/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="/backend/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="/backend/css/main.css">

        <!-- Include a specific file here from /css/themes/ folder to alter the default theme of the template -->
        @if (\Config::get('backend.template.theme'))
        <link rel="stylesheet" href="/backend/css/themes/{{ \Config::get('backend.template.theme') }}>.css" id="theme-link">
        @endif

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="/backend/css/themes.css">
        <!-- END Stylesheets -->
        <link rel="stylesheet" href="/backend/css/jamp_customize.css">

        <!-- Modernizr (browser feature detection library) -->
        <script src="/backend/js/vendor/modernizr-2.8.3.min.js"></script>

        <link rel="stylesheet" type="text/css" href="/backend/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

        <script>
        js_strings = {
            filemanager: {
                apkey: "{{ \Config::get('app.filemanager.key') }}"
            }
        }
        </script>
    </head>
    <body>
        @include('backend.parts.header')

        <!-- Page content -->
        <div id="page-content">
            
            @section('top_sidebar')
                @include('backend.parts.content_header')
            @show

            @section('messages')
            <div id="messages"></div>
            <div id="form-messages"></div>
            @show

            @yield('content')
        </div>
        <!-- END Page Content -->
        <?php
        /*
        @include('backend.parts.dialog')
        */
        ?>
        @include('backend.parts.footer')
        @include('backend.parts.scripts')


        @yield('page_scripts')

    </body>
</html>