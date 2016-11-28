@extends('backend.articles.layout')

@section('form')

	{{ JForm::FormOpen(action('Backend_ArticlesController@update', array($article->id)), 'PUT') }}
    	{{ JForm::Text('Article__title', $article) }}
    	{{ JForm::Editor('Article__intro', $article) }}
    	{{ JForm::Editor('Article__description', $article) }}
    	{{ JForm::Text('Article__tag', $article) }}
    	{{ JForm::FileManager('Article__image', $article) }}
        {{ JForm::Text('Article__link', $article) }}
        {{ JForm::Select2('Article__viewinc', $article, array('elements' => $articlespaths)) }}
    	{{ JForm::Profile($article) }}
    	{{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop