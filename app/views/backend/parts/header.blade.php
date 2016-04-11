<?php
/**
 * page_head.php
 *
 * Author: pixelcave
 *
 * The head of each page
 *
 */
?>

<!-- Page Wrapper -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available classes:

    'page-loading'      enables page preloader
-->
<div id="page-wrapper"
@if (\Config::get('backend.template.page_preloader'))
 class="page-loading"
@endif
 >
    <!-- Preloader -->
    <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
    <!-- Used only if page preloader enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
    <div class="preloader">
        <div class="inner">
            <!-- Animation spinner for all modern browsers -->
            <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

            <!-- Text for IE9 -->
            <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
        </div>
    </div>
    <!-- END Preloader -->

    <!-- Page Container -->
    <!-- In the PHP version you can set the following options from inc/config file -->
    <!--
        Available #page-container classes:

        'sidebar-light'                                 for a light main sidebar (You can add it along with any other class)

        'sidebar-visible-lg-mini'                       main sidebar condensed - Mini Navigation (> 991px)
        'sidebar-visible-lg-full'                       main sidebar full - Full Navigation (> 991px)

        'sidebar-alt-visible-lg'                        alternative sidebar visible by default (> 991px) (You can add it along with any other class)

        'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
        'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

        'fixed-width'                                   for a fixed width layout (can only be used with a static header/main sidebar layout)

        'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links (You can add it along with any other class)
    -->
    <?php
        $page_classes = '';

        if (\Config::get('backend.template.header') == 'navbar-fixed-top')
        {
            $page_classes = 'header-fixed-top';
        }
        else if (\Config::get('backend.template.header') == 'navbar-fixed-bottom')
        {
            $page_classes = 'header-fixed-bottom';
        }

        if (\Config::get('backend.template.sidebar'))
        {
            $page_classes .= (($page_classes == '') ? '' : ' ') . \Config::get('backend.template.sidebar');
        }

        if (\Config::get('backend.template.layout') == 'fixed-width' && \Config::get('backend.template.header') == '')
        {
            $page_classes .= (($page_classes == '') ? '' : ' ') . \Config::get('backend.template.layout');
        }

        if (\Config::get('backend.template.cookies') === 'enable-cookies') {
            $page_classes .= (($page_classes == '') ? '' : ' ') . \Config::get('backend.template.cookies');
        }
    ?>
    <div id="page-container"
    @if ($page_classes)
     class="{{ $page_classes }}"
    @endif
    >
    <?php /*
        <?php if (template['inc_sidebar_alt']) { include 'inc/' . template['inc_sidebar_alt'] . '.php'; } ?>
        <?php if (template['inc_sidebar']) { include 'inc/' . template['inc_sidebar'] . '.php'; } ?>
    */
        ?>
        @include('backend.parts.sidebar_alt')
        @include('backend.parts.sidebar')

        <!-- Main Container -->
        <div id="main-container">
            <?php //if (template['inc_header']) { include 'inc/' . template['inc_header'] . '.php'; } ?>
            @include('backend.parts.page_header')
