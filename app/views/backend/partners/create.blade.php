@extends('backend.partners.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_PartnersController@store'), 'POST') }}
		{{ JForm::Hidden('Partner__status', 1) }}
        {{ JForm::Text('Partner__title', $partner) }}
        {{ JForm::FileManager('Partner__image', $partner) }}
        {{ JForm::Text('Partner__link', $partner) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop