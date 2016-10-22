@extends('backend.news.layout')

@section('form')

@include('backend.galleries.show', array('gallery' => $active_gallery, 'model' => 'News', 'model_id' => $news->id))

@stop


