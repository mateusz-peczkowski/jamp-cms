@extends('backend.layouts.base')


@section('content')

    <!-- Datatables is initialized in js/pages/uiTables.js -->
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.article.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_ArticlesController@create'),
        		'text'		=>	trans('backend.create'),
                'class'     =>  'btn btn-success',

        		),
        	);
        ?>
        {{ JForm::Toolbar($toolbar_buttons) }}


        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.article.title') }}</th>
                        <!-- <th style="width: 120px;">Status</th> -->
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $num-> $article)
                    <?php $change_status_action = $article->status ? 'deactivate' : 'activate'; ?>
                    <tr class="status-{{ $article->status }}">
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $article->title }}</strong></td>
                        <td class="text-center">
                        	<?php
                             $buttons = array(
                                array(
                                    'url'   => action('Backend_ArticlesController@edit', $article->id),
                                    'type'  => 'edit',
                                    'tooltip'=> trans('backend.edit'),
                                    ),
                                array(
                                    'url'   => action('Backend_ArticlesController@' . $change_status_action, $article->id),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action('Backend_ArticlesController@delete', $article->id),
                                    'type'  => 'check_delete',
                                    'tooltip'=> trans('backend.check_delete'),
                                    'class' =>  'ajax-delete',
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
    <!-- END Datatables Block -->
</div>
<!-- END Page Content -->

@stop

@section('page_scripts')

<script src="/backend/js/pages/uiTables.js"></script>
<script>$(function(){ UiTables.init(); });</script>

@stop