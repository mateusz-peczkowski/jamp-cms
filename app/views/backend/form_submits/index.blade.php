@extends('backend.layouts.base')

@section('content')

    <div class="block full">
    <?php 
    $tabs = array();
    $tabs[] = array(
        'title' =>  trans('backend.formsubmit.all'),
        'url'   =>  action('Backend_FormSubmitsController@index', array('all')),
        'active'    => !$active_form->id,
        );

    foreach ($forms as $form)
    {
        $tabs[] = array(
            'title' =>  $form->title,
            'url'   =>  action('Backend_FormSubmitsController@index', $form->id),
            'active'    =>  $form->id == $active_form->id,
            'class' =>  'status-' . $form->status,
            );
    }
    ?>
 
    <div class="block">
        <div class="block-title">
        {{ JForm::Tabs($tabs) }}
        </div>
         
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">ID</th>
                        <th>{{ trans('backend.formsubmit.imortant_data') }}</th>
                        @if (!$active_form->id)
                        <th>{{ trans('backend.form.type') }}</th>
                        @endif
                        <th>{{ trans('backend.formsubmit.created_at') }}</th>

                        <th class="text-center" style="width: 75px;"><i class="fa fa-flash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submits as $num => $submit)
                    <tr data-id="{{ $submit->id }}">
                         <td class="text-center">{{ $num+1 }}</td>
                        <td class="status">
                            {{ $submit->email }} {{ $submit->name }} {{ $submit->firstname }} {{ $submit->lastname }}
                        </td>
                        @if (!$active_form->id)
                        <td>{{ $submit->form->title }}</td>
                        @endif
                        <td>{{ $submit->created_at }}</td>
                        <td class="text-center">
                            <?php
                             $buttons = array(
                                array(
                                    'url'   => action('Backend_FormSubmitsController@show', $submit->id),
                                    'type'  => 'show',
                                    'tooltip'=> trans('backend.show'),
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

    
    </div>
    <!-- END Datatables Block -->
</div>
<!-- END Page Content -->

@stop

@section('page_scripts')




@stop