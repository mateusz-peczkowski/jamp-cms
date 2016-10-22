<?php
/**
 * page_sidebar.php
 *
 * Author: pixelcave
 *
 * The main sidebar of each page
 *
 */
?>
<!-- Main Sidebar -->
<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a href="/cmsbackend" class="sidebar-title" style="background: #454E59; ">
            <img src="/backend/jampsystem/symbol_a.png" height="18" style="margin-top: -4px; margin-right: 5px; " />
            <span class="sidebar-nav-mini-hide">{{ \Config::get('backend.template.client_name') }}</span>
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            @if (\Config::has('backend.navigation'))
            <!-- Sidebar Navigation -->
            <ul class="sidebar-nav">
                @foreach(\Config::get('backend.navigation') as $key => $node)

                <?php
                 $icon = (isset($link['icon']) && $link['icon']) ? '<i class="' . $link['icon'] . ' sidebar-nav-icon"></i>' : '';
                 $url = Backend::GetMenuLink($node);
                 $active = Backend::IsActivePage($node);
                 // var_dump($active);
                 $active_class = $active ? 'active' : '';
                 $li_class = $active_class;
                 $a_class = $active_class;
                ?>

                @if (isset($node['type']) && $node['type'] == 'separator')
                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>
                @else

                <?php
                $subnodes = Backend::Subnodes($node);
                if ($subnodes)
                {
                    $a_class .= ' sidebar-nav-menu';
                }
                ?>
                <li class="{{ $li_class }}">
                    <a href="{{ $url }}" class="{{ $a_class }}">
                        @if ($subnodes)
                        <i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                        @endif
                        @if(isset($node['icon']))
                        <i class="{{ $node['icon'] }} sidebar-nav-icon"></i>
                        @endif
                        <span class="sidebar-nav-mini-hide">{{ $node['name'] }}</span>
                    </a>
                    @if ($subnodes)

                    <ul>
                        @foreach ($subnodes as $subnode) 

                        <?php
                            $link_class = '';
                            $li_active = '';
                            $submenu_link = '';
                            $url        = Backend::GetMenuLink($subnode);
                            $active = Backend::IsActivePage($subnode);
                            $active_class = $active ? 'active' : '';
                            $li_class = $active_class;
                            $a_class = $active_class;
                        ?>
                        <li class="{{ $li_class }}">

                            <a href="{{ $url }}" class="{{ $a_class }}">
                            @if (Backend::Subnodes($subnode))
                            <i class="fa fa-chevron-left sidebar-nav-indicator"></i>
                            @endif
                            {{ $subnode['name'] }}
                            </a>

                        </li>

                        @endforeach
                    </ul>
                    
                    @endif
                </li>

                @endif

                @endforeach
            </ul>
            <!-- END Sidebar Navigation -->
            @endif

            <?php 
            /*
            <!-- Color Themes -->
            <!-- Preview a theme on a page functionality can be found in js/app.js - colorThemePreview() -->
            <div class="sidebar-section sidebar-nav-mini-hide">
                <div class="sidebar-separator push">
                    <i class="fa fa-ellipsis-h"></i>
                </div>
                <ul class="sidebar-themes clearfix">
                    <li>
                        <a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip" title="Default" data-theme="default" data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                            <span class="section-side themed-background-dark-default"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip" title="Classy" data-theme="css/themes/classy.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                            <span class="section-side themed-background-dark-classy"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip" title="Social" data-theme="css/themes/social.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                            <span class="section-side themed-background-dark-social"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip" title="Flat" data-theme="css/themes/flat.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                            <span class="section-side themed-background-dark-flat"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-amethyst" data-toggle="tooltip" title="Amethyst" data-theme="css/themes/amethyst.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                            <span class="section-side themed-background-dark-amethyst"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip" title="Creme" data-theme="css/themes/creme.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                            <span class="section-side themed-background-dark-creme"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip" title="Passion" data-theme="css/themes/passion.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="">
                            <span class="section-side themed-background-dark-passion"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip" title="Default + Light Sidebar" data-theme="default" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                            <span class="section-side"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip" title="Classy + Light Sidebar" data-theme="css/themes/classy.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                            <span class="section-side"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip" title="Social + Light Sidebar" data-theme="css/themes/social.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                            <span class="section-side"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip" title="Flat + Light Sidebar" data-theme="css/themes/flat.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                            <span class="section-side"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-amethyst" data-toggle="tooltip" title="Amethyst + Light Sidebar" data-theme="css/themes/amethyst.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                            <span class="section-side"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip" title="Creme + Light Sidebar" data-theme="css/themes/creme.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                            <span class="section-side"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip" title="Passion + Light Sidebar" data-theme="css/themes/passion.css" data-theme-navbar="navbar-inverse" data-theme-sidebar="sidebar-light">
                            <span class="section-side"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-default" data-toggle="tooltip" title="Default + Light Header" data-theme="default" data-theme-navbar="navbar-default" data-theme-sidebar="">
                            <span class="section-header"></span>
                            <span class="section-side themed-background-dark-default"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-classy" data-toggle="tooltip" title="Classy + Light Header" data-theme="css/themes/classy.css" data-theme-navbar="navbar-default" data-theme-sidebar="">
                            <span class="section-header"></span>
                            <span class="section-side themed-background-dark-classy"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-social" data-toggle="tooltip" title="Social + Light Header" data-theme="css/themes/social.css" data-theme-navbar="navbar-default" data-theme-sidebar="">
                            <span class="section-header"></span>
                            <span class="section-side themed-background-dark-social"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-flat" data-toggle="tooltip" title="Flat + Light Header" data-theme="css/themes/flat.css" data-theme-navbar="navbar-default" data-theme-sidebar="">
                            <span class="section-header"></span>
                            <span class="section-side themed-background-dark-flat"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-amethyst" data-toggle="tooltip" title="Amethyst + Light Header" data-theme="css/themes/amethyst.css" data-theme-navbar="navbar-default" data-theme-sidebar="">
                            <span class="section-header"></span>
                            <span class="section-side themed-background-dark-amethyst"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-creme" data-toggle="tooltip" title="Creme + Light Header" data-theme="css/themes/creme.css" data-theme-navbar="navbar-default" data-theme-sidebar="">
                            <span class="section-header"></span>
                            <span class="section-side themed-background-dark-creme"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="themed-background-passion" data-toggle="tooltip" title="Passion + Light Header" data-theme="css/themes/passion.css" data-theme-navbar="navbar-default" data-theme-sidebar="">
                            <span class="section-header"></span>
                            <span class="section-side themed-background-dark-passion"></span>
                            <span class="section-content"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Color Themes -->
            */
            ?>
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->


    <!-- Sidebar Extra Info -->
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
<!--         <div class="push-bit">
            <span class="pull-right">
                <a href="javascript:void(0)" class="text-muted"><i class="fa fa-plus"></i></a>
            </span>
            <small><strong>78 GB</strong> / 100 GB</small>
        </div>
        <div class="progress progress-mini push-bit">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%"></div>
        </div> -->
        <div class="text-center">
            <small>{{ \Config::get('backend.template.signature') }}</small>
        </div>
    </div>
    <!-- END Sidebar Extra Info -->

</div>
<!-- END Main Sidebar -->
