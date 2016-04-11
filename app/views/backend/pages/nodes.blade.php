<?php $breadcrumbs = $page->breadcrumbs() ?>
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>{{ trans('backend.info.page.' . $action) }}</strong></h3>
                @if ($breadcrumbs)
                <h5>{{ trans('backend.info.page.' . $action . '_summary') }}</h5>
                @endif
            </div>
            {{ JForm::ModalFormOpen(action('Backend_PagesController@' . $action, array($page->id)), 'PUT') }}
            @if ($breadcrumbs)
            <div class="modal-body">

            @foreach ($breadcrumbs as $navigation_id => $data)

            <div class="block-section">
                <h4 class="sub-header">{{ $data['navigation']->title }}</h4>
                <ol class="breadcrumb">
                    <li><a href="javascript:void(0)"><i class="fa fa-home"></i></a></li>

                    @foreach ($data['breadcrumb'] as $node)
                    <li><a href="javascript:void(0)">{{ $node->title }}</a></li>
                    @endforeach
                </ol>
            </div>
            <br>
            <br>
            @endforeach
            </div>
            
            @endif
            <div class="modal-footer">
                {{ JForm::FormButtons() }}
            </div>
            {{ JForm::FormClose() }}
        </div>
    </div>
</div>