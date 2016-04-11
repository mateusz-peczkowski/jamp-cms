@extends('backend.layouts.base')


@section('content')

    <!-- Datatables is initialized in js/pages/uiTables.js -->
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.news.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_NewsController@create'),
        		'text'		=>	trans('backend.news.create'),
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
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

        	    	@foreach ($news as $num => $new)
                    <?php $change_status_action = $new->status ? 'deactivate' : 'activate'; ?>
                    <tr data-id="{{ $new->id }}" class="status-{{ $new->status }}">
                        <td class="text-center">{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $new->title }}</strong></td>
                        <td class="text-center">
                        	<?php
                        	 $buttons = array(
				            	array(
				            		'url'	=> action('Backend_NewsController@edit', $new->id),
				            		'type' 	=> 'edit',
				            		'tooltip'=> trans('backend.edit'),
				            		),
                                 array(
                                    'url'   => action('Backend_NewsController@' . $change_status_action, $new->id),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action('Backend_NewsController@delete', $new->id),
                                    'type'  => 'delete',
                                    'tooltip'=> trans('backend.delete'),
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

<script src="js/pages/uiTables.js"></script>
<script>$(function(){ UiTables.init(); });</script>

@stop