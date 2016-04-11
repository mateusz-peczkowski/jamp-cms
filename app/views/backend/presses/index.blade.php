@extends('backend.layouts.base')


@section('content')

    <!-- Datatables is initialized in js/pages/uiTables.js -->
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.press.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_PressesController@create'),
        		'text'		=>	trans('backend.press.create'),
                'class'     =>  'btn btn-success',

        		),
        	);
        ?>
        {{ JForm::Toolbar($toolbar_buttons) }}


        <div class="table-responsive">
            <table class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

        	    	@foreach ($presses as $num => $press)
                    <?php $change_status_action = $press->status ? 'deactivate' : 'activate'; ?>

                    <tr data-id="{{ $press->id }}"  class="status-{{ $press->status }}">
                        <td class="text-center">{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $press->title }}</strong></td>
                        <td class="text-center">
                        	<?php
                        	 $buttons = array(
				            	array(
				            		'url'	=> action('Backend_PressesController@edit', $press->id),
				            		'type' 	=> 'edit',
				            		'tooltip'=> trans('backend.edit'),
				            		),
                                 array(
                                    'url'   => action('Backend_PressesController@' . $change_status_action, $press->id),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action('Backend_PressesController@delete', $press->id),
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


@stop