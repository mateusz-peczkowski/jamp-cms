@extends('backend.layouts.base')

@section('content')

 	<div class="block full">

    {{ JForm::FormOpen('', '') }}
    	@foreach ($submit->form->controls as $control)
    	<div class="form-group">
            <label class="control-label">{{ $control->label }}</label>
            <p class="form-control-static">{{ $submit->submitdata($control->name) }}</p>
        </div>
    	@endforeach
        {{ JForm::Label('FormSubmit__ip', $submit) }}
        {{ JForm::Label('FormSubmit__created_at', $submit) }}
    {{ JForm::FormClose() }}
    {{ JForm::BlockClose() }}

@stop