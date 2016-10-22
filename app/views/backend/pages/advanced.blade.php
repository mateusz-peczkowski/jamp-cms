@extends('backend.pages.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_PagesController@update', array($page->id)), 'PUT') }}
		{{ JForm::Text('Page__tag', $page) }}
		{{ JForm::Text('Page__controller', $page) }}
		{{ JForm::Text('Page__view', $page) }}
		{{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop