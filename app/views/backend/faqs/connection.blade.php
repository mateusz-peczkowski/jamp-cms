<?php
$faqs = $object->connection('Faq', 0);
?>

@if (isset($object) && $object)
<?php
    $toolbar_buttons = array(
    array(
        'type'      =>  'create',
        'url'       =>  action('Backend_FaqsController@create') . '?category_id=' . $object->id,
        'text'      =>  trans('backend.faq.create'),
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

	    	@foreach ($faqs as $num => $faq)
            <?php $change_status_action = $faq->status ? 'deactivate' : 'activate'; ?>
            <tr data-id="{{ $faq->id }}" class="status-{{ $faq->status }}">
                 <td class="text-center handle"><i class="fa fa-sort"></i>&nbsp;&nbsp;&nbsp;{{ $num+1 }}</td>
                <td class="status"><strong>{{ $faq->question }}</strong></td>
                <td class="text-center">
                	<?php
                	 $buttons = array(
		            	array(
		            		'url'	=> action('Backend_FaqsController@edit', $faq->id),
		            		'type' 	=> 'edit',
		            		'tooltip'=> trans('backend.edit'),
		            		),
                        array(
                            'url'   => action('Backend_FaqsController@' . $change_status_action, $faq->id),
                            'type'  => $change_status_action,
                            'tooltip'=> trans('backend.' . $change_status_action),
                            'class' =>  'ajax-' . $change_status_action,
                            ),
                        array(
                            'url'   => action('Backend_FaqsController@delete', $faq->id),
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

@section('page_scripts')
@parent
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
            SendAjax('{{ action('Backend_ConnectionsController@sortable_connection', array(get_class($object), $object->id, "Faq")) }}', 'POST', {ids: window.JSON.stringify(ids)});
        },
        handle: ".handle"
        
    });
})

</script>

@stop