@extends('backend.news.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_NewsController@update', array($news->id)), 'PUT') }}
        {{ JForm::Text('News__title', $news) }}
        {{ JForm::Editor('News__intro', $news) }}
        {{ JForm::Editor('News__description', $news) }}
        {{ JForm::FileManager('News__image', $news) }}
        {{ JForm::Text('News__author', $news) }}
        {{ JForm::Date('News__date', $news) }}
        {{ JForm::Hidden('News__url', $news) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop
