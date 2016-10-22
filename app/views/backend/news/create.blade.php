@extends('backend.news.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_NewsController@store'), 'POST') }}
        {{ JForm::Hidden('News__status', 1) }}
        {{ JForm::Text('News__title', $news) }}
        {{ JForm::Editor('News__intro', $news) }}
        {{ JForm::Editor('News__description', $news) }}
        {{ JForm::FileManager('News__image', $news) }}
        {{ JForm::Text('News__author', $news) }}
        {{ JForm::Text('News__date', $news) }}
        {{ JForm::Hidden('News__url', $news) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop