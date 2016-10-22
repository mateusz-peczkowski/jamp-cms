<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>{{ trans('backend.additionaldata.edit') }}</strong></h3>
            </div>
            {{ JForm::ModalFormOpen(action('Backend_AdditionalDatasController@update', array($data->id)), 'PUT') }}
            <div class="modal-body">
                {{ JForm::Text('AdditionalData__value', $data) }}
            </div>
            <div class="modal-footer">
                {{ JForm::FormButtons() }}
            </div>
            {{ JForm::FormClose() }}
        </div>
    </div>
</div>