<div class="block-section">
    <input type="hidden" name="GalleryMedia__path" id="GalleryMedia__path">
    <a href="{{ \Config::get('app.filemanager.path') }}type=2&amp;field_id=GalleryMedia__path" class="btn btn-success filemanager_jamp" type="button"><i class="fa fa-plus"></i> {{ trans('backend.gallery.media.create') }}</a>
</div>

@if ($gallery)

<div class="row gallery" id="gallery-sortable">

    @foreach ($gallery->medias as $media)
    <div class="col-sm-3 media-sortable" data-id="{{ $media->id }}">
        <div class="gallery-image-container animation-fadeInQuick2" imgLiquid="true">
            @if ($media->is_video)
            <video width="320" height="200">
              <source src="{{ $media->original }}" type="{{ $media->type }}">
                Your browser does not support the video tag.
            </video>
            @else
            <img src="{{ $media->original }}" alt="Image" >
            @endif
            <a href="javascript:void(0)" class="gallery-image-options" title="Image Info">
                <?php /*<h2 class="text-light"><strong>{{ $media->title }}</strong></h2>*/ ?>
                <div class="col-md-12">
                    <div class="btn-group">
                        <button href="{{ action('Backend_GalleryMediasController@edit', array($media->id)) }}" class="btn btn-default  ajax_modal"><i class="{{ \Config::get('backend.icons.edit') }}"></i></button>
                        <button class="btn btn-default" href="{{ $media->original }}" data-toggle="lightbox-image"><i class="{{ \Config::get('backend.icons.preview') }}"></i></button>
                        <button href="{{ action('Backend_GalleryMediasController@destroy', array($media->id)) }}" class="btn btn-default destroy_image"><i class="{{ \Config::get('backend.icons.destroy') }}"></i></button>
                    </div>
                </div>
            </a>
        </div>
    </div>

    @endforeach

</div>

@endif


@section('page_scripts')
<!-- Load and execute javascript code used only in this page -->
<script src="/backend/js/pages/compGallery.js"></script>
<script>$(function(){ CompGallery.init(); });</script>
<script>
    GalleryMode = true;
    Model = '{{ $model }}';
    ModelID = '{{ $model_id }}';
    GalleryID = '{{ $gallery->id }}';
    AddImageUrl = '{{ action('Backend_GalleryMediasController@store') }}';
</script>
<script>
  $(function() {
    $( "#gallery-sortable" ).sortable({

        out: function( event, ui ) {

            var ids = [];
            $(this).children('.media-sortable').each(function(){

                ids.push($(this).data('id'));

            });
            SendAjax('{{ action('Backend_GalleriesController@sortable_medias', array($gallery->id)) }}', 'POST', {ids: window.JSON.stringify(ids)});

        }
        
    });
    $( "#gallery-sortable" ).disableSelection();

    $('body').on('click', '.destroy_image', function(e) {

        e.preventDefault();
        SendAjax($(this).attr('href'), 'DELETE');

    });

    $('body').on('click', '.edit_image', function(e) {

        e.preventDefault();
        SendAjax($(this).attr('href'), 'GET');

    });

  });
  </script>


@stop