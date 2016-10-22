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
            SendAjax('{{ action(Backend::GetControllerAction('sortable')) }}', 'POST', {ids: window.JSON.stringify(ids)});

        },
        handle: ".handle"
        
    });
})

</script>