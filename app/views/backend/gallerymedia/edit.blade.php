<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>{{ trans('backend.gallerymedia.edit') }}</strong></h3>
            </div>
            {{ JForm::ModalFormOpen(action('Backend_GalleryMediasController@update', array($media->id)), 'PUT') }}
            <div class="modal-body">
                {{ JForm::Label('GalleryMedia__type', $media) }}
                {{ JForm::Label('GalleryMedia__path', $media) }}
            	{{ JForm::Text('GalleryMedia__title', $media) }}
            	{{ JForm::Text('GalleryMedia__link', $media) }}
            	{{ JForm::Text('GalleryMedia__link_title', $media) }}
                {{-- JForm::Editor('GalleryMedia__description', $media) --}}
            	{{ JForm::TextArea('GalleryMedia__description', $media) }}
            </div>
            <div class="modal-footer">
                {{ JForm::FormButtons() }}
            </div>
            {{ JForm::FormClose() }}
        </div>
    </div>
</div>