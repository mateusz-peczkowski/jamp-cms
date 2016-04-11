@extends('backend.forms.layout')

@section('form')



        <?php
        $toolbar_buttons = array(
            array(
                'type'      =>  'create',
                'url'       =>  action('Backend_FormControlsController@create', array($form->id)),
                'text'      =>  trans('backend.form_control.create'),
                'class'     =>  'btn btn-success',

                ),
            );
        ?>
        {{ JForm::Toolbar($toolbar_buttons) }}


        <div class="table-responsive">
            <table class="datatable table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.title') }}</th>
                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($controls as $num => $control)
                    <?php $change_status_action = $control->status ? 'deactivate' : 'activate'; ?>
                    <tr data-id="{{ $control->id }}" class="status-{{ $control->status }}">
                        <td class="text-center">{{ $num+1 }}</td>
                        <td class="status"><strong>{{ $control->label }}</strong></td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                array(
                                    'url'   => action('Backend_FormControlsController@edit', array($form->id, $control->id)),
                                    'type'  => 'edit',
                                    'tooltip'=> trans('backend.edit'),
                                    ),
                                 array(
                                    'url'   => action('Backend_FormControlsController@' . $change_status_action, array($control->id)),
                                    'type'  => $change_status_action,
                                    'tooltip'=> trans('backend.' . $change_status_action),
                                    'class' =>  'ajax-' . $change_status_action,
                                    ),
                                array(
                                    'url'   => action('Backend_FormControlsController@delete', array($control->id)),
                                    'type'  => 'delete',
                                    'tooltip'=> trans('backend.delete'),
                                    'class' =>  'ajax-delete',
                                    ),
                                );
                            ?>
                            @foreach ($buttons as $button)
                                {{ JForm::Button($button) }}
                            @endforeach
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>


@stop

@section('page_scripts')

@stop