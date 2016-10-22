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

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        @if (\Config::get('backend.template.theme'))
        <link rel="stylesheet" href="/backend/css/themes/{{ \Config::get('backend.template.theme') }}.css" id="theme-link">
        @endif

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="/backend/css/themes.css">
        <!-- END Stylesheets -->

        <link rel="stylesheet" href="/backend/css/jamp_customize.css">


        <!-- Modernizr (browser feature detection library) -->
        <script src="/backend/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>

        <!-- Login Container -->
        <div id="login-container">
            <!-- Login Header -->
            <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
                <div>{{ \Config::get('backend.template.title') }}</div>
            </h1>
            <!-- END Login Header -->

            <!-- Login Block -->
            <div class="block animation-fadeInQuickInv">
                <!-- Login Title -->
                <div class="block-title">
                    <div class="block-options pull-right">
                        <!-- <a href="page_ready_reminder.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Forgot your password?"><i class="fa fa-exclamation-circle"></i></a> -->
                        <!-- <a href="page_ready_register.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Create new account"><i class="fa fa-plus"></i></a> -->
                    </div>
                    <h2>Please Login</h2>
                </div>
                <!-- END Login Title -->

                <!-- Login Form -->
                <form id="form-login" action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" id="login-email" name="email" class="form-control" placeholder="Your email..">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="password" id="login-password" name="password" class="form-control" placeholder="Your password..">
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <!-- <div class="col-xs-8">
                            <label class="csscheckbox csscheckbox-primary">
                                <input type="checkbox" id="login-remember-me" name="login-remember-me">
                                <span></span>
                            </label>
                            Remember Me?
                        </div> -->
                        <div class="col-xs-4 text-right">
                            <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Let's Go</button>
                        </div>
                    </div>
                </form>
                <!-- END Login Form -->
            </div>
            <!-- END Login Block -->

            <!-- Footer -->
            <footer class="text-muted text-center animation-pullUp">
                <small><span id="year-copy">{{ date('Y') }}</span> &copy; {{ \Config::get('backend.template.signature') }}</small>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Login Container -->

         <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
                <script src="/backend/js/vendor/bootstrap.min.js"></script>
                <script src="/backend/js/plugins.js"></script>
                <script src="/backend/js/app.js"></script>
                <script src="/backend/js/imgLiquid-min.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="/backend/js/pages/readyLogin.js"></script>
        <script>$(function(){ ReadyLogin.init(); });</script>


    </body>
</html>