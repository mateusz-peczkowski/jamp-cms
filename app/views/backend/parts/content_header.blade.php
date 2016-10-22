<?php 
$breadcrumbs = Backend::Breadcrumb(); 
?>
<div class="content-header">
    <div class="row">
        <div class="col-sm-6">
            <div class="header-section">
                <h1>{{ Backend::SidebarHeaderText() }}</h1>
            </div>
        </div>
        <div class="col-sm-6 hidden-xs">
            <div class="header-section">
                <ul class="breadcrumb breadcrumb-top">
                    @foreach ($breadcrumbs as $crumb)
                    <li><a href="{{ $crumb['url'] }}">{{ $crumb['name'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>