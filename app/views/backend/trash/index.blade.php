@extends('backend.layouts.base')


@section('content')

    <!-- Datatables is initialized in js/pages/uiTables.js -->
    @if(sizeof($pages))
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.page.index') }}</h2>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($pages as $num => $trash_itm)
                    <tr data-id="{{ $trash_itm->id }}" class="status-{{ $trash_itm->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $trash_itm->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                array(
                                    'url'   => action('Backend_PagesController@deactivate', $trash_itm->id),
                                    'type'  => 'restore',
                                    'tooltip'=> trans('backend.restore'),
                                    // 'class' =>  'page-ajax-' . $change_status_action,
                                    'class' =>  'ajax-restore',
                                    ),
                                array(
                                    'url'   => action('Backend_PagesController@destroyever', $trash_itm->id),
                                    'type'  => 'destroyever',
                                    'tooltip'=> trans('backend.destroyever'),
                                    'class' =>  'ajax-destroyever',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- END Datatables Block -->

    <!-- Datatables is initialized in js/products/uiTables.js -->
    @if(sizeof($products))
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.product.index') }}</h2>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($products as $num => $trash_itm)
                    <tr data-id="{{ $trash_itm->id }}" class="status-{{ $trash_itm->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $trash_itm->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                 array(
                                    'url'   => action('Backend_ProductsController@deactivate', $trash_itm->id),
                                    'type'  => 'restore',
                                    'tooltip'=> trans('backend.restore'),
                                    'class' =>  'ajax-restore',
                                    ),
                                array(
                                    'url'   => action('Backend_ProductsController@destroyever', $trash_itm->id),
                                    'type'  => 'destroyever',
                                    'tooltip'=> trans('backend.destroyever'),
                                    'class' =>  'ajax-destroyever',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- END Datatables Block -->

    <!-- Datatables is initialized in js/faqs/uiTables.js -->
    @if(sizeof($faqs))
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.faq.index') }}</h2>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($faqs as $num => $trash_itm)
                    <tr data-id="{{ $trash_itm->id }}" class="status-{{ $trash_itm->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $trash_itm->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                 array(
                                    'url'   => action('Backend_FaqsController@deactivate', $trash_itm->id),
                                    'type'  => 'restore',
                                    'tooltip'=> trans('backend.restore'),
                                    'class' =>  'ajax-restore',
                                    ),
                                array(
                                    'url'   => action('Backend_FaqsController@destroyever', $trash_itm->id),
                                    'type'  => 'destroyever',
                                    'tooltip'=> trans('backend.destroyever'),
                                    'class' =>  'ajax-destroyever',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- END Datatables Block -->

    <!-- Datatables is initialized in js/news/uiTables.js -->
    @if(sizeof($news))
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.news.index') }}</h2>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($news as $num => $trash_itm)
                    <tr data-id="{{ $trash_itm->id }}" class="status-{{ $trash_itm->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $trash_itm->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                 array(
                                    'url'   => action('Backend_NewsController@deactivate', $trash_itm->id),
                                    'type'  => 'restore',
                                    'tooltip'=> trans('backend.restore'),
                                    'class' =>  'ajax-restore',
                                    ),
                                array(
                                    'url'   => action('Backend_NewsController@destroyever', $trash_itm->id),
                                    'type'  => 'destroyever',
                                    'tooltip'=> trans('backend.destroyever'),
                                    'class' =>  'ajax-destroyever',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- END Datatables Block -->

    <!-- Datatables is initialized in js/partners/uiTables.js -->
    @if(sizeof($partners))
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.partner.index') }}</h2>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($partners as $num => $trash_itm)
                    <tr data-id="{{ $trash_itm->id }}" class="status-{{ $trash_itm->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $trash_itm->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                 array(
                                    'url'   => action('Backend_PartnersController@deactivate', $trash_itm->id),
                                    'type'  => 'restore',
                                    'tooltip'=> trans('backend.restore'),
                                    'class' =>  'ajax-restore',
                                    ),
                                array(
                                    'url'   => action('Backend_PartnersController@destroyever', $trash_itm->id),
                                    'type'  => 'destroyever',
                                    'tooltip'=> trans('backend.destroyever'),
                                    'class' =>  'ajax-destroyever',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- END Datatables Block -->

    <!-- Datatables is initialized in js/presses/uiTables.js -->
    @if(sizeof($presses))
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.press.index') }}</h2>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($presses as $num => $trash_itm)
                    <tr data-id="{{ $trash_itm->id }}" class="status-{{ $trash_itm->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $trash_itm->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                 array(
                                    'url'   => action('Backend_PressesController@deactivate', $trash_itm->id),
                                    'type'  => 'restore',
                                    'tooltip'=> trans('backend.restore'),
                                    'class' =>  'ajax-restore',
                                    ),
                                array(
                                    'url'   => action('Backend_PressesController@destroyever', $trash_itm->id),
                                    'type'  => 'destroyever',
                                    'tooltip'=> trans('backend.destroyever'),
                                    'class' =>  'ajax-destroyever',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- END Datatables Block -->

    <!-- Datatables is initialized in js/teams/uiTables.js -->
    @if(sizeof($teams))
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.team.index') }}</h2>
        </div>

        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($teams as $num => $trash_itm)
                    <tr data-id="{{ $trash_itm->id }}" class="status-{{ $trash_itm->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $trash_itm->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                 array(
                                    'url'   => action('Backend_TeamsController@deactivate', $trash_itm->id),
                                    'type'  => 'restore',
                                    'tooltip'=> trans('backend.restore'),
                                    'class' =>  'ajax-restore',
                                    ),
                                array(
                                    'url'   => action('Backend_TeamsController@destroyever', $trash_itm->id),
                                    'type'  => 'destroyever',
                                    'tooltip'=> trans('backend.destroyever'),
                                    'class' =>  'ajax-destroyever',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- END Datatables Block -->

</div>
<!-- END Page Content -->

@stop

@section('page_scripts')

<script src="/backend/js/pages/uiTables.js"></script>
<script>$(function(){ UiTables.init(); });</script>

@stop