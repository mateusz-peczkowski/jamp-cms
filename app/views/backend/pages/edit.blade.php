@extends('backend.pages.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_PagesController@update', array($page->id)), 'PUT') }}
        {{ JForm::Text('Page__title', $page) }}
        {{ JForm::Editor('Page__body', $page) }}
        {{ JForm::Text('Page__url', $page) }}
        {{ JForm::Profile($page) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop