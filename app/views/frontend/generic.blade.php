@extends('frontend.layouts.base')

@section('main')

generic
{{ CMS::trans('test.nowy') }}
@include('frontend.parts.articles')

@stop