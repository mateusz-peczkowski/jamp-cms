@extends('backend.layouts.base')


@section('content')

    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.custommodule.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_CustomModulesRecordsController@create'),
        		'params'	=>	array('custom_module_id' => $custom_module->id),
        		'text'		=>	trans('backend.modules.custom_module.create'),
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

        	    	@foreach ($custom_module->records as $num => $record)

                    <tr>
                        <td class="text-center">{{ $num+1 < 10 ? '0' : '' }}{{ $num+1 }}</td>
                        <td><strong>{{ $record->title }}</strong></td>
                        <td class="text-center">
                        	<?php
                        	 $buttons = array(
				            	array(
				            		'url'	=> action('Backend_CustomModulesRecordsController@edit', $record->id),
				            		'type' 	=> 'edit',
				            		'tooltip'=> trans('backend.modules.custom_module.edit'),
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