@extends('backend.layouts.base')

@section('content')
 	
	<?php 
    foreach ($allow_tabs as $allow_tab)
    {
        $tabs[] = array(
            'title' =>  trans('backend.form.' . $allow_tab),
            'url'   =>  action('Backend_FormsController@' . $allow_tab, array($form->id)),
            'active'    =>  $allow_tab == $tab,
            );
    }
    ?>
    <?php 
    $block_open_params = array('tabs' => $tabs);
    if (isset($language_mode) && $language_mode)
    {
        $block_open_params['languages'] = $languages;
    }
    ?>
 	{{ JForm::BlockOpen($block_open_params) }}
    @yield('form')
    {{ JForm::BlockClose() }}
    @yield('other_block')

@stop