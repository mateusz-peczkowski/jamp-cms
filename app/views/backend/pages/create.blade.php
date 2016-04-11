@extends('backend.layouts.base')

@section('content')

 	{{ JForm::BlockOpen(array('text' => trans('backend.page.create'))) }}
    	{{ JForm::FormOpen(action('Backend_PagesController@store'), 'POST') }}
    		{{ JForm::Hidden('Page__status', 1) }}
	    	{{ JForm::Text('Page__title', $page) }}
        	{{ JForm::Editor('Page__body', $page) }}
        	{{ JForm::Text('Page__url', $page) }}
        	{{ JForm::Profile($page) }}
        	{{ JForm::FormButtons() }}
	    {{ JForm::FormClose() }}
	{{ JForm::BlockClose() }}

@stop