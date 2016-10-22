@extends('backend.layouts.base')

@section('content')

<style type="text/css" media="screen">
#example1.handsontable table{
    width:100%;
}

#example1.handsontable table thead tr th, #example1.handsontable table tbody tr td{
    width:50%;
}
    
</style>

    <div class="block full">
        <div class="block-title">
            <h2>{{ trans('backend.modredirect.index') }}</h2>
        </div>
        {{ JForm::InfoAlert(trans('backend.modredirect.info.url_address')) }}
         <?php
        $toolbar_buttons = array(
            array(
                'type'      =>  'update',
                'url'       =>  action('Backend_ModredirectsController@save'),
                'text'      =>  trans('backend.update'),
                'class'     =>  'btn btn-primary',
                'id'        =>  'save',

                ),
            );
        ?>
        {{ JForm::Toolbar($toolbar_buttons) }}

        <div id="example1"></div>
       
    </div>
</div>

@stop

@section('page_scripts')

    <script data-jsfiddle="common" src="/backend/handsonetable/handsontable.full.js"></script>
    <link data-jsfiddle="common" rel="stylesheet" media="screen" href="/backend/handsonetable/handsontable.full.css">
    <script data-jsfiddle="example1">


        function ajax (url, method, callback, params) {
          var obj;
          try {
            obj = new XMLHttpRequest();
          } catch (e) {
            try {
              obj = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
              try {
                obj = new ActiveXObject("Microsoft.XMLHTTP");
              } catch (e) {
                alert("Your browser does not support Ajax.");
                return false;
              }
            }
          }
          obj.onreadystatechange = function () {

            if (obj.readyState == 4) {
              callback(obj);
            }
          };
          obj.open(method, url, true);
          obj.send(params);
          return obj;
        };

        var container = document.getElementById("example1"),
          load = document.getElementById('load'),
          save = document.getElementById('save'),
          hot1 = new Handsontable(container,{
            startRows: 1,
            startCols: 3,
            rowHeaders: false,
            colHeaders: ["{{ trans('backend.modredirect.from_url') }}", "{{ trans('backend.modredirect.to_url') }}"],
            colWidths: [50, 50],
           
            minSpareRows: 1,
            afterChange: function (change, source) {
              if (source === 'loadData') {
                return;
              }
            }
          });

          ajax(
            "{{ action('Backend_ModredirectsController@json_data') }}",
            'GET',
            function (res) {
              var data = JSON.parse(res.response);
              hot1.loadData(data.data);
            }
          );

        Handsontable.Dom.addEvent(save,'click', function (e){
            e.preventDefault();

          ajax(
            "{{ action('Backend_ModredirectsController@save') }}",
            'POST',
            function (res) {

              var response = JSON.parse(res.response);
                Display(response);
            },
            JSON.stringify({"data": hot1.getData()}) //returns all cells' data
          );
        });
      </script>

@stop