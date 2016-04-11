@extends('backend.pages.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_PagesController@update', array($page->id)), 'PUT') }}
		{{ JForm::Text('Page__meta_title', $page) }}
		{{ JForm::TextArea('Page__meta_description', $page) }}
		{{ JForm::TextArea('Page__meta_keywords', $page) }}
		{{ JForm::TextArea('Page__meta_robots', $page) }}
		{{ JForm::TextArea('Page__meta_head', $page) }}
		{{ JForm::TextArea('Page__meta_footer', $page) }}
		{{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop