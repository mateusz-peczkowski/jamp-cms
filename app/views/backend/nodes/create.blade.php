<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Modal</strong></h3>
            </div>
            {{ JForm::ModalFormOpen(action('Backend_NodesController@store') . '?navigation_id=' . $navigation_id . '&parent_id=' . $parent_id, 'POST') }}
            <div class="modal-body">
                {{ JForm::Select2('Node__page_id', $node, array('elements' => (array('0' => trans('backend.page.new')) + $pages))) }}
            </div>
            <div class="modal-footer">
                {{ JForm::FormButtons() }}
            </div>
            {{ JForm::FormClose() }}
        </div>
    </div>
</div>