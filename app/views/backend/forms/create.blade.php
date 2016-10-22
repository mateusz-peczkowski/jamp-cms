@extends('backend.forms.layout')

@section('form')

	{{ JForm::FormOpen(action('Backend_FormsController@store'), 'POST') }}
		{{ JForm::Hidden('Form__status', 1) }}
    	{{ JForm::Text('Form__title', $form) }}
    	{{ JForm::Text('Form__tag', $form) }}
        {{ JForm::Select2('Form__type', $form, array('elements' => \Config::get('forms.allow_types'), 'value' => $form->type)) }}
    	{{-- JForm::Select2('Form__type', $form, array('elements' => \Config::get('forms.allow_types'))) --}}
    	{{-- JForm::Editor('Form__body', $form) --}}
    	{{ JForm::Text('Form__sender_name', $form) }}
        {{ JForm::Text('Form__sender_email', $form) }}
        {{ JForm::CheckBox('Form__confirmation', $form) }}
        {{ JForm::Text('Form__notification_email', $form) }}
    	{{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop