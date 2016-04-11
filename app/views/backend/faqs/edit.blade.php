@extends('backend.faqs.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_FaqsController@update', array($faq->id)), 'PUT') }}
      	{{ JForm::Text('Faq__question', $faq) }}
      	{{ JForm::Select2('FaqCategory__id', $category->id, array('elements' => $categories)) }}
        {{ JForm::Editor('Faq__answer', $faq) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop