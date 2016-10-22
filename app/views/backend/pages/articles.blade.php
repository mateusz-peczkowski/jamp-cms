@extends('backend.pages.layout')

@section('form')

@include('backend.articles.connection', array('object' => $page))

@stop