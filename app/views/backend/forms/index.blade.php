@extends('backend.layouts.base')

@section('content')

    <div class="block full">

    <?php 
    $tabs = array();
    if (isset($forms) && isset($active_form))
    {
	    foreach ($forms as $form)
	    {

	        $tabs[] = array(
	            'title' =>  $form->title,
	            'url'   =>  action('Backend_FormsController@index', array($form->id)),
	            'active'    =>  $form->id == $active_form->id,
                'class' =>  'status-' . $form->status,
                );
        }

    }
    $tabs[] = array(
        'title' =>  '<i class="' . \Config::get('backend.toolbar.buttons.create') . '"></i>',
        'url'   =>  action('Backend_FormsController@create'),
    );
    ?>
 
    <div class="block">
        <div class="block-title">
        {{ JForm::Tabs($tabs) }}
        </div>
    
    @if (isset($active_form))
    <?php
    $change_status_action = $active_form->status ? 'deactivate' : 'activate';
    $toolbar1_buttons = array(
    array(
        'type'      =>  'edit',
        'url'       =>  action('Backend_FormsController@edit', array($active_form->id)),
        'text'      =>  trans('backend.form.edit'),
        'class'     =>  'btn btn-primary',
        ),
     array(
        'url'   => action('Backend_FormsController@' . $change_status_action, $active_form->id),
        'type'  => $change_status_action,
        'text'      =>  trans('backend.' . $change_status_action),
        'class' =>  'btn btn-warning ajax-' . $change_status_action,
        ),
      // array(
      //   'type'      =>  'delete',
      //   'url'       =>  action('Backend_FormsController@delete', array($active_form->id)),
      //   'text'      =>  trans('backend.faqcategory.delete'),
      //   'class'     =>  'btn btn-danger ajax-delete',
      //   ),
    );
	?>
	<div style="float: left; margin-right: 5px; margin-top: 7px;">{{ trans('backend.form.id') }}: </div>
	{{ JForm::Toolbar($toolbar1_buttons) }}
     
	<!-- formcontrols -->
	
	<?php
	    $toolbar_buttons = array(
	    array(
	        'type'      =>  'create',
	        'url'       =>  action('Backend_FormControlsController@create', array($active_form->id)),
	        'text'      =>  trans('backend.create'),
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

                    @foreach ($active_form->controls as $control)
                    <tr data-id="{{ $control->id }}">
                        <td class="text-center handle"><i class="fa fa-sort"></i>&nbsp;&nbsp;&nbsp;{{ $control->id }}</td>
                        <td class="status"><strong>{{ $control->label }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                array(
                                    'url'   => action('Backend_FormControlsController@edit', array($control->form_id, $control->id)),
                                    'type'  => 'edit',
                                    'tooltip'=> trans('backend.edit'),
                                    ),
                                array(
                                    'url'   => action('Backend_FormControlsController@delete', array($control->id)),
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

    @endif

    </div>
    <!-- END Datatables Block -->
</div>
<!-- END Page Content -->

@stop

@section('page_scripts')
<script>

$(function(){

// add css width for all td, because when sortable td did small
$( "#sortable td" ).each(function(){

    $(this).css('width', $(this).width());

});

$( "#sortable" ).sortable({

        out: function( event, ui ) {

            var ids = [];
            $(this).children('tr').each(function(){

                ids.push($(this).data('id'));

            });
            SendAjax('{{ action("Backend_FormControlsController@sortable") }}', 'POST', {ids: window.JSON.stringify(ids)});

        },
        handle: ".handle"
        
    });
})

</script>
@stop