@extends('backend.' . $view_dir . '.layout')

@section('form')

    {{ JForm::FormOpen(action(Backend::GetController() . '@store'), 'POST') }}
    	{{ JForm::Hidden($model_name . '__status', 1) }}
		@yield('controls')
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop