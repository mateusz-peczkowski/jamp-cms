@extends('backend.layouts.base')


@section('content')

    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.partner.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_PartnersController@create'),
        		'text'		=>	trans('backend.partner.create'),
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
                <tbody id="sortable">

        	    	@foreach ($partners as $num => $partner)
                    <?php $change_status_action = $partner->status ? 'deactivate' : 'activate'; ?>
                    <tr data-id="{{ $partner->id }}" class="status-{{ $partner->status }}">
                         <td class="text-center handle"><i class="fa fa-sort"></i>&nbsp;&nbsp;&nbsp;{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $partner->title }}</strong></td>
                        <td class="text-center">
                        	<?php
                        	 $buttons = array(
				            	array(
				            		'url'	=> action('Backend_PartnersController@edit', $partner->id),
				            		'type' 	=> 'edit',
				            		'tooltip'=> trans('backend.edit'),
				            		),
                                array(
                                    'url'   => action('Backend_PartnersController@' . $change_status_action, $partner->id),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action('Backend_PartnersController@delete', $partner->id),
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