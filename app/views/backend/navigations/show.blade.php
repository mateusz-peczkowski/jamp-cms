@extends('backend.layouts.base')

@section('content')

     <?php 
            $tabs = array();
            foreach ($navigations as $nav)
            {
                $tabs[] = array(
                    'title' =>  $nav->title,
                    'url'   =>  action('Backend_NavigationsController@show', array($nav->id)),
                    'active'    =>  $nav->id == $navigation->id,
                    );
            }
            ?>

    {{ JForm::BlockOpen(array('tabs' => $tabs)) }}

        <?php
        $toolbar_buttons = array(
        	array(
        		'type'		=>	'create',
        		'url'		=>	action('Backend_NodesController@create'),
        		'params'	=>	array('navigation_id' => $navigation->id),
        		'text'		=>	'Add node',
        		'class'		=>	'ajax_modal btn btn-success',
        		)
        	);
        ?>
        {{ JForm::Toolbar($toolbar_buttons) }}

        <?php 



        function render_subnodes($node)
        {
        	$ret = '';
        	if (count($node->subnodes))
        	{
				$ret .= '<ol class="dd-list">';
        		foreach ($node->subnodes as $subnode)
        		{
					$ret .= '<li class="dd-item" data-id="' . $subnode->id . '">';
					$ret .= item($subnode);
					$ret .= render_subnodes($subnode);
					$ret .= '</li>';
        		}
				$ret .= '</ol>';
        	}
        	return $ret;
        }

        function item($node)
        {
        	$item = '<div class="dd-handle dd3-handle">Drag</div>
                        <div class="dd3-content">' . 
                        	$node->title;
            $buttons = array(
            	array(
            		'url'	=> action('Backend_PagesController@edit', $node->page_id),
            		'type' 	=> 'edit',
            		'tooltip'=> 'Edit page',
            		),
            	array(
            		'url' => action('Backend_NodesController@create'),
            		'params' => array(
            			'navigation_id' => $node->navigation_id,
            			'parent_id' => $node->id,
            			),
            		'type' => 'create',
            		'tooltip'=> 'Create node',
	        		'class'	=>	'ajax_modal',

            		),
            	array(
            		'url' => action('Backend_NodesController@destroy', $node->id),
            		'type' => 'destroy',
            		'class' => 'node_destroy',
            		'tooltip'=> 'Destroy node',
            		),
            	);
            $item .= '<span class="right buttons">';
            foreach ($buttons as $button)
            {
            	$item .= JForm::Button($button) ;
            }
                       
            $item .= '</span></div>';
            return $item;
        }

        ?>

        <!-- Example Lists Content -->
        <div class="row" id="tree">
            <div class="col-sm-4 col-sm-offset-1">

            	@if ($navigation)

                <div id="nestable1" class="dd">
                    <ol class="dd-list">

                    @foreach ($navigation->nodes as $node)

                        <li class="dd-item" data-id="{{ $node->id }}">
                           
                        	{{ item($node) }}
                        	{{ render_subnodes($node) }}
                        </li>

                    @endforeach

                    </ol>
                </div>

                @endif

                <div class="hide" id="nestable1-output"></div>
            </div>

        </div>
        <!-- END Example Lists Content -->
        {{ JForm::BlockClose() }}

@stop

@section('page_scripts')

<!-- Load and execute javascript code used only in this page -->
<script>

var CompNestable = function() {

    /* Output serialised data function */
    var updateOutput = function(e, init) {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');

        if (window.JSON) {
            output.html(window.JSON.stringify(list.nestable('serialize')));
            if (!init)
            {
            	SendAjax('{{ action('Backend_NavigationsController@refreshTree', array($navigation->id)) }}', 'POST', { tree_structure: window.JSON.stringify(list.nestable('serialize')) })
	            
            }
        } else {
            output.html('JSON browser support required!');
        }
    };

    return {
        init: function() {
            var nestLists = $('.dd');
            var nestList1 = $('#nestable1');
          
            nestList1
                .nestable({
                    group: 1
                })
                .on('change', updateOutput);


            // Output initial serialised data
            updateOutput(nestList1.data('output', $('#nestable1-output')), 1);

            // Collapse/Expand functionality
            $('#nestable-actions > a').on('click', function(e){
               var nestAction = $(this).data('action');

                if (nestAction == 'collapse') {
                   nestLists.nestable('collapseAll');
               } else if (nestAction == 'expand') {
                   nestLists.nestable('expandAll');
               }
            });
        }
    };
}();
</script>
<script>$(function(){ CompNestable.init(); });</script>

<script>

$(function(){

	$('body').on('click', '.node_destroy', function(e){

		e.preventDefault();
		SendAjax($(this).attr('href'), 'DELETE',{},  function(){ReloadContainer('#tree');});

	});

})
</script>

@stop