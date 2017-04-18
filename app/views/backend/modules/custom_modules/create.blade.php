@extends('backend.layouts.base')

@section('content')

 	{{ JForm::BlockOpen(array('text' => $custom_module->title . ' ' . trans('backend.modules.custom_module.create'))) }}
    	{{ JForm::FormOpen(action('Backend_CustomModulesRecordsController@store'), 'POST') }}
            {{ JForm::Hidden('CustomModulesRecord__status', 1) }}
            {{ JForm::Hidden('CustomModulesRecord__custom_module_id', $custom_module->id) }}

            @foreach ($custom_module->fields() as $field_name => $field_config)

            {{ JForm::{$field_config['type']}('CustomModulesRecord__' . $field_name, $custom_module_record, array('label' => $field_config['title'])) }}

            @endforeach

        	{{ JForm::FormButtons() }}
	    {{ JForm::FormClose() }}
	{{ JForm::BlockClose() }}

@stop