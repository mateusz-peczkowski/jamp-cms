@extends('backend.layouts.base')


@section('content')

    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.team.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_TeamsController@create'),
        		'text'		=>	trans('backend.team.create'),
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
                        <th>{{ trans('backend.name') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody id="sortable">

        	    	@foreach ($teams as $num => $team)
                    <?php $change_status_action = $team->status ? 'deactivate' : 'activate'; ?>

                    <tr data-id="{{ $team->id }}"   class="status-{{ $team->status }}">
                         <td class="text-center handle"><i class="fa fa-sort"></i>&nbsp;&nbsp;&nbsp;{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $team->firstname . ' ' . $team->lastname }}</strong></td>
                        <td class="text-center">
                        	<?php
                        	 $buttons = array(
				            	array(
				            		'url'	=> action('Backend_TeamsController@edit', $team->id),
				            		'type' 	=> 'edit',
				            		'tooltip'=> trans('backend.edit'),
				            		),
                                array(
                                    'url'   => action('Backend_TeamsController@' . $change_status_action, $team->id),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action('Backend_TeamsController@delete', $team->id),
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

@include('backend.parts.scripts.sortable')

@stop