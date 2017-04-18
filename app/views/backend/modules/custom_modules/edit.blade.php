@extends('modules.custom_modules.layout')

@section('form')

    {{ JForm::FormOpen(action('CustomModulesRecordsController@update', array($custom_module_record->id)), 'PUT') }}

      	 @foreach ($custom_module_record->module->fields() as $field_name => $field_config)

            {{ JForm::{$field_config['type']}('CustomModulesRecord__' . $field_name, $custom_module_record, array('label' => $field_config['title'])) }}

            @endforeach
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop