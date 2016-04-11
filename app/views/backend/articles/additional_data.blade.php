@extends('backend.articles.layout')

@section('form')

@include('backend.additional_datas.index', array('obj' => $article))

@stop