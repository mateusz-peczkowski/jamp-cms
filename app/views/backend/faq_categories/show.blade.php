@extends('backend.layouts.base')

@section('content')

    <div class="block full">

    <?php 
    $tabs = array();
    if (isset($categories) && isset($active_category))
    {
	    foreach ($categories as $category)
	    {

	        $tabs[] = array(
	            'title' =>  '<i class="fa fa-sort horizontally"></i> &nbsp;' . $category->title,
	            'url'   =>  action('Backend_FaqCategoriesController@show', array($category->id)),
	            'active'    =>  $category->id == $active_category->id,
                'class' =>  'handle-tab status-' . $category->status,
                'data-id'   =>  $category->id,
                );
        }
    }
    $tabs[] = array(
        'title' =>  '<i class="' . \Config::get('backend.toolbar.buttons.create') . '"></i>',
        // 'description'    =>  '',
        // 'icon'   =>  'create',
        'url'   =>  action('Backend_FaqCategoriesController@create'),
        'class' =>  'ui-state-disabled',
        );
    ?>
 
    <div class="block">
        <div class="block-title">
        {{ JForm::Tabs($tabs, array('tabs_id' => 'tabs-sortable')) }}
        </div>
    
    @if (isset($active_category))
    <?php
    $change_status_action = $active_category->status ? 'deactivate' : 'activate';
    $toolbar1_buttons = array(
    array(
        'type'      =>  'edit',
        'url'       =>  action('Backend_FaqCategoriesController@edit', array($active_category->id)),
        'text'      =>  trans('backend.faqcategory.edit'),
        'class'     =>  'btn btn-primary',
        ),
     array(
        'url'   => action('Backend_FaqCategoriesController@' . $change_status_action, $active_category->id),
        'type'  => $change_status_action,
        'text'      =>  trans('backend.' . $change_status_action),
        'class' =>  'btn btn-warning ajax-' . $change_status_action,
        ),
      array(
        'type'      =>  'delete',
        'url'       =>  action('Backend_FaqCategoriesController@delete', array($active_category->id)),
        'text'      =>  trans('backend.faqcategory.delete'),
        'class'     =>  'btn btn-danger ajax-delete',
        ),
    );
?>
<div style="float: left; margin-right: 5px; margin-top: 7px;">{{ trans('backend.faqcategory.id') }}: </div>
{{ JForm::Toolbar($toolbar1_buttons) }}
     
    @include('backend.faqs.connection', array('object' => $active_category))
    @endif

    </div>
    <!-- END Datatables Block -->
</div>
<!-- END Page Content -->

@stop

@section('page_scripts')

<script type="text/javascript">
    
// add css width for all td, because when sortable td did small
// $( "#sortable td" ).each(function(){

//     $(this).css('width', $(this).width());

// });
$(function(){

    // tab sortable
    $( "#tabs-sortable" ).sortable({
        items: "li:not(.ui-state-disabled)", 
            out: function( event, ui ) {

                var ids = [];
                $(this).find('li.handle-tab').each(function(){

                    ids.push($(this).data('id'));

                });
                
                
            SendAjax('{{ action(Backend::GetControllerAction("sortable")) }}', 'POST', {ids: window.JSON.stringify(ids)});
                        
            }/*,
            handle: ".handle"*/
            
        });
    $( "#sort li" ).disableSelection();
})
</script>


@stop