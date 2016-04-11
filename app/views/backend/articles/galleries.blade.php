@extends('backend.articles.layout')

@section('form')
@include('backend.galleries.show', array('gallery' => $active_gallery, 'model' => 'Article', 'model_id' => $article->id))

@stop

<?php 
/*


$pills = array();

foreach ($page->galleries as $gallery)
{
    $pills[] = array(
        'title' =>  $gallery->title,
        'url'   =>  action('PagesController@galleries', array($page->id, $gallery->id)),
        'params'    =>  array(
            'tab'   =>  'gallery',
            'gallery_id'    =>  $gallery->id,
            ),
        'active' => ($gallery->id == $active_gallery->id),
        );
}
    $pills[] = array(
        'title' =>  trans('backend.galleries.new'),
        'url'   =>  \URL::current(),
        'params'    =>  array(
            'tab'   =>  'gallery',
            // 'gallery_id'    =>  $gallery->id,
            ),
        );

*/
?>

{{-- JForm::Pills($pills) --}}


