@extends('backend.articles.layout')

@section('form')

	{{ JForm::FormOpen(action('Backend_ArticlesController@store'), 'POST') }}
		{{ JForm::Hidden('Article__status', 1) }}
    	{{ JForm::Text('Article__title', $article) }}
    	{{ JForm::Editor('Article__intro', $article) }}
    	{{ JForm::Editor('Article__description', $article) }}
    	{{ JForm::Text('Article__tag', $article) }}
    	{{ JForm::FileManager('Article__image', $article) }}
    	{{ JForm::Text('Article__link', $article) }}
        {{ JForm::Profile($article) }}
    	{{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop