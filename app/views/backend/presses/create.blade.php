@extends('backend.presses.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_PressesController@store'), 'POST') }}
		{{ JForm::Hidden('Press__status', 1) }}
        {{ JForm::Text('Press__title', $press) }}
        {{-- JForm::Editor('Press__intro', $press) --}}
        {{ JForm::Editor('Press__description', $press) }}
        {{ JForm::Text('Press__date', $press) }}
        {{ JForm::FileManager('Press__file', $press) }}
        {{ JForm::Text('Press__link', $press) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop