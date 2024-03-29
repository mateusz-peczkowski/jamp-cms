<!-- Header -->
<!-- In the PHP version you can set the following options from inc/config file -->
<!--
    Available header.navbar classes:

    'navbar-default'            for the default light header
    'navbar-inverse'            for an alternative dark header

    'navbar-fixed-top'          for a top fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar())
        'header-fixed-top'      has to be added on #page-container only if the class 'navbar-fixed-top' was added

    'navbar-fixed-bottom'       for a bottom fixed header (fixed main sidebar with scroll will be auto initialized, functionality can be found in js/app.js - handleSidebar()))
        'header-fixed-bottom'   has to be added on #page-container only if the class 'navbar-fixed-bottom' was added
-->
<?php
$class = '';
if (\Config::get('backend.template.header_navbar'))
{
    $class .= ' ' . \Config::get('backend.template.header_navbar');
}
if (\Config::get('backend.template.header'))
{
    $class .= ' ' . \Config::get('backend.template.header');
}

?>
<header class="navbar {{ $class }}">
    <!-- Left Header Navigation -->
    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->
        <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
            </a>
        </li>
        <!-- END Main Sidebar Toggle Button -->

        @if (\Config::get('backend.template.header_link'))
        <!-- Header Link -->
        <li class="hidden-xs animation-fadeInQuick">
            <a href=""><strong>{{ \Config::get('backend.template.header_link') }}</strong></a>
        </li>
        <!-- END Header Link -->
        @endif
    </ul>
    <!-- END Left Header Navigation -->


    <!-- Right Header Navigation -->
    <ul class="nav navbar-nav-custom pull-right">
        <!-- Search Form -->
        <!-- <li>
            <form action="page_ready_search_results.php" method="post" class="navbar-form-custom" role="search">
                <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
            </form>
        </li> -->
        <!-- END Search Form -->

        <!-- Alternative Sidebar Toggle Button -->
        <!-- <li>
            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                <i class="gi gi-settings"></i>
            </a>
        </li> -->
        <!-- END Alternative Sidebar Toggle Button -->

        <!-- User Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                <img src="/backend/jampsystem/symbol_a_white.png" alt="avatar">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
               <!--  <li class="dropdown-header">
                    <strong>ADMINISTRATOR</strong>
                </li>
                <li>
                    <a href="page_app_email.php">
                        <i class="fa fa-inbox fa-fw pull-right"></i>
                        Inbox
                    </a>
                </li>
                <li>
                    <a href="page_app_social.php">
                        <i class="fa fa-pencil-square fa-fw pull-right"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="page_app_media.php">
                        <i class="fa fa-picture-o fa-fw pull-right"></i>
                        Media Manager
                    </a>
                </li>
                <li class="divider"><li>
                <li>
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                        <i class="gi gi-settings fa-fw pull-right"></i>
                        Settings
                    </a>
                </li>

                <li>
                    <a href="page_ready_lock_screen.php">
                        <i class="gi gi-lock fa-fw pull-right"></i>
                        Lock Account
                    </a>
                </li>  -->
                <li>
                    <a href="/cmsbackend/logout">
                        <i class="fa fa-power-off fa-fw pull-right"></i>
                        {{trans('backend.logout')}}
                    </a>
                </li>
            </ul>
        </li>
        <!-- END User Dropdown -->
    </ul>
    <!-- END Right Header Navigation -->

</header>
<!-- END Header -->
