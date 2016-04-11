<?php
$articles = $object->connection('Article');
?>

 <?php
        $toolbar_buttons = array(
            array(
                'type'      =>  'create',
                'url'       =>  action('Backend_ConnectionsController@create_connection', array(get_class($object), $object->id, 'Article')),
                'text'      =>  trans('backend.create'),
                'class'     =>  'ajax_modal btn btn-success',
                )
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

                    @foreach ($articles as $article)
                    <tr data-id="{{ $article->id }}">
                        <td class="text-center handle"><i class="fa fa-sort"></i>&nbsp;&nbsp;&nbsp;{{ $article->id }}</td>
                        <td class="status"><strong>{{ $article->title }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                array(
                                    'url'   => action('Backend_ArticlesController@edit', $article->id),
                                    'type'  => 'edit',
                                    'tooltip'=> trans('backend.edit'),
                                    ),
                                array(
                                    'url'   => action('Backend_ConnectionsController@delete_connection', array(get_class($object), $object->id, get_class($article), $article->id)),
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
            SendAjax('{{ action('Backend_ConnectionsController@sortable_connection', array(get_class($object), $object->id, "Article")) }}', 'POST', {ids: window.JSON.stringify(ids)});
        },
        handle: ".handle"
        
    });
})

</script>

@stop