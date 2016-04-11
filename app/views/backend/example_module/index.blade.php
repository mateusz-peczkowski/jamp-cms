@extends('backend.layouts.base')


@section('content')

    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.' . strtolower($model_name) . '.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action(Backend::GetController() . '@create'),
        		'text'		=>	trans('backend.create'),
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
                        @yield('th')
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody id="sortable">

        	    	@foreach ($elements as $num => $element)
                    <?php $change_status_action = $element->status ? 'deactivate' : 'activate'; ?>

                    <tr data-id="{{ $element->id }}"   class="status-{{ $element->status }}">
                        <td class="text-center handle"><i class="fa fa-sort"></i>&nbsp;&nbsp;&nbsp;{{ $num+1 }}</td>
                        @include('backend.' . $view_dir . '.index_td')
                        <td class="text-center">
                        	<?php
                        	 $buttons = array(
				            	array(
				            		'url'	=> action(Backend::GetController() . '@edit', $element->id),
				            		'type' 	=> 'edit',
				            		'tooltip'=> trans('backend.edit'),
				            		),
                                array(
                                    'url'   => action(Backend::GetController() . '@' . $change_status_action, $element->id),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action(Backend::GetController() . '@delete', $element->id),
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