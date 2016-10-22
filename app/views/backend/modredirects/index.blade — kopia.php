@extends('backend.layouts.base')

@section('content')

    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.modredirect.index') }}</h2>
        </div>
        {{ JForm::FormOpen(action('Backend_ModredirectsController@update'), 'PUT') }}
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th>from</th>
                        <th>to</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

        	    	@foreach ($redirects as $redirect)
                    <tr>
                        <td><input type="text" name="from_url[{{ $redirect->id }}]" value="{{ $redirect->from_url }}"  class="form-control" placeholder="{{ trans('backend.modredirect.from_url') }}"></td>
                        <td><input type="text" name="to_url[{{ $redirect->id }}]" value="{{ $redirect->to_url }}"  class="form-control" placeholder="{{ trans('backend.modredirect.to_url') }}"></td>
                        <td class="text-center">
                        	<?php
                        	 $buttons = array(
                                array(
                                    'url'   => action('Backend_ModredirectsController@destroy', $redirect->id),
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
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <button id="create-row" type="button" class="btn btn-block btn-primary">{{ trans('backend.modredirect.store') }}</button>
                                </div>
                                <div class="col-xs-6">
                                    <button id="update-all" type="button" class="btn btn-block btn-success">{{ trans('backend.modredirect.update') }}</button>
                                </div>
                            </div>
                            
                        </div>
                    </tr>
                </tfoot>
            </table>
        </div>
    {{ JForm::FormClose() }}
    </div>
    <!-- END Datatables Block -->
</div>
<!-- END Page Content -->


@stop

@section('page_scripts')

<script>
$(function(){

    $('body').on('click', '#create-row', function(e){

            <?php
             $buttons = array(
                array(
                    // 'url'   => action('Backend_ModredirectsController@destroy', $redirect->id),
                    'type'  => 'delete',
                    'tooltip'=> trans('backend.delete'),
                    'class' =>  'ajax-delete',
                    ),
                );
            ?>
            @foreach ($buttons as $button)
                var buttons = '{{ preg_replace("/\s\s+/", " ", JForm::Button($button)) }}';
            @endforeach

        var table = $(this).parents('table');
        table.find('tbody').append('<tr><td><input type="text" name="from_url[]" value=""  class="form-control" placeholder="{{ trans('backend.modredirect.from_url') }}"></td><td><input type="text" name="to_url[]" value=""  class="form-control" placeholder="{{ trans('backend.modredirect.to_url') }}"></td><td class="text-center">' + buttons + '</td></tr>');

    });

    $('body').on('click', '#update-all', function(e){

           e.preventDefault();
           var form = $(this).parents('form');
           alert(form.serialize());

    });

})    
</script>

@stop