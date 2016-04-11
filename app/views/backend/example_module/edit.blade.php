@extends('backend.' . $view_dir . '.layout')

@section('form')

    {{ JForm::FormOpen(action(Backend::GetController() . '@update', array($element->id)), 'PUT') }}
		@yield('controls')
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop