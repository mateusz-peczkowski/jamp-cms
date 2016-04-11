@extends('backend.teams.layout')

@section('form')

    {{ JForm::FormOpen(action('Backend_TeamsController@update', array($team->id)), 'PUT') }}
        {{ JForm::Text('Team__firstname', $team) }}
        {{ JForm::Text('Team__lastname', $team) }}
        {{ JForm::Text('Team__position', $team) }}
        {{ JForm::Editor('Team__description', $team) }}
        {{ JForm::FileManager('Team__image', $team) }}
        {{ JForm::FormButtons() }}
    {{ JForm::FormClose() }}

@stop