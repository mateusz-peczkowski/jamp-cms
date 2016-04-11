@extends('backend.layouts.base')


@section('content')

    <!-- Datatables is initialized in js/pages/uiTables.js -->
    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.page.index') }}</h2>
        </div>

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_PagesController@create'),
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
                        <th>Title, url</th>
                        <!-- <th style="width: 120px;">Status</th> -->
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

        	    	@foreach ($pages as $num => $page)
                    <?php $change_status_action = $page->status ? 'deactivate' : 'activate'; ?>
                    <tr class="status-{{ $page->status }}">
                        <td class="text-center">{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $page->title }}</strong> {{ $page->url }}</td>
                        <?php /*<td>{{ $page->status }}</td>*/ ?>
                        <td class="text-center">
                        	<?php
                             $buttons = array(
                                array(
                                    'url'   => action('Backend_PagesController@edit', $page->id),
                                    'type'  => 'edit',
                                    'tooltip'=> trans('backend.edit'),
                                    ),
                                array(
                                    'url'   => action('Backend_PagesController@' . $change_status_action, $page->id),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    // 'class' =>  'page-ajax-' . $change_status_action,
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action('Backend_PagesController@check_delete', $page->id),
                                    'type'  => 'check_delete',
                                    'tooltip'=> trans('backend.check_delete'),
                                    'class' =>  'ajax_modal',
                                    // 'class' =>  'page-ajax-delete',
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

<script>

$('body').on('click', 'a.page-ajax-activate', function(e){
    
    SendAjax($(this).attr('href'), 'PUT');    e.preventDefault();
    SendAjax($(this).attr('href'), 'PUT');

});

</script>

@stop