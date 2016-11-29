<!DOCTYPE html>
<html lang="pl">
    <head>
        @include('frontend.parts.head')
    </head>
    <body class="{{ isset($isHome) ? 'hp' : 'sec' }}">
        @include('frontend.parts.cookie')

        @include('frontend.parts.header')

        <div id="wrapper">

            @yield('main')
            
        </div>

        @include('frontend.parts.footer')

        @section('scripts')
            <script src="/js/app.js"></script>
            <script src="/js/trans/{{\Config::get('app.locale')}}.js"></script>
        @show

        {{ $global_page->meta('footer') }}
    </body>
</html>