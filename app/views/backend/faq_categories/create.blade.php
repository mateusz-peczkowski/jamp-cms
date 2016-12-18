@extends('backend.faq_categories.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_FaqCategoriesController@store'), 'POST') }}
		{{ JForm::Hidden('FaqCategory__status', 1) }}
        {{ JForm::Text('FaqCategory__title', $category) }}
        <!-- TODO:delete button -->
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop