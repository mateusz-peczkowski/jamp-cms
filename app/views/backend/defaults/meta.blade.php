@extends('backend.defaults.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_DefaultsController@update', array($tab)), 'PUT') }}
		{{ JForm::Hidden('Page__tag', 'default') }}
		{{ JForm::Hidden('Page__status', 1) }}
		{{ JForm::Hidden('Page__title', $page->title ?: 'Page default') }}
		{{ JForm::Text('Page__meta_title', $page) }}
		{{ JForm::TextArea('Page__meta_description', $page) }}
		{{ JForm::TextArea('Page__meta_keywords', $page) }}
		{{ JForm::TextArea('Page__meta_robots', $page) }}
		{{ JForm::TextArea('Page__meta_head', $page) }}
		{{ JForm::TextArea('Page__meta_footer', $page) }}
		{{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop