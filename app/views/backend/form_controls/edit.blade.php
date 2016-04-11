@extends('backend.forms.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_FormControlsController@update', array($form->id, $control->id)), 'PUT') }}
      	 {{ JForm::Hidden('FormControl__status', 1) }}
        {{ JForm::Text('FormControl__name', $control) }}
        {{ JForm::Text('FormControl__label', $control) }}
        {{ JForm::Select2('FormControl__type', $control, array('elements' => \Config::get('forms.controls.allow_types'), 'value' => $control->type)) }}
        {{ JForm::Text('FormControl__default', $control) }}
        {{ JForm::Text('FormControl__values', $control) }}
        {{ JForm::Text('FormControl__rules', $control) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop