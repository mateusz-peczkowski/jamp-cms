function SendAjax(url, method, data, callback)
{
	var ret = true;
	$.ajax({
		type: method,
		url: url,
	  	data: data
	})
	.done(function( msg ) {
		if (msg.status == 'OK')
		{
			if (msg.redirect)
			{
				window.location.href = msg.redirect;
			}
			else if (msg.reload)
			{
				window.location.reload();
			}
			else
			{
				if (msg.message)
				{
					Display(msg);
				}

				if (typeof callback === "function")
				{
				    callback();
			    }
			}
		}
		else
		{
			// status = fail
			Display(msg);
			ret = false;
			// alert('error');
		}
	})
	.fail(function() {
		Display({status:'ERROR', message:'Server Error'});
		ret = false;
		// alert('fail');
	});

	return ret;
}


function Display(msg)
{
	// msg.status
	// msg.message
	if (msg instanceof Object)
	{
		if (msg.status == 'OK')
		{
			$('#form-messages').empty();
			$('#form-messages').html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>' + msg.message + '</p></div>');
			// scroll to message
			$('html, body').animate({
	    		scrollTop: 0
			}, 1000);
		}
		else
		{
			$.each(msg.message, function( index, values ) {

				var control = $('[name=' + index + ']');
				var control_group = control.parent('.form-group');

				control_group.addClass('has-error');
				 // <div id="val-username-error" class="help-block animation-pullUp">Please enter a username</div>
				var message = '';
				$.each(values, function (k, v) {
					message += '<li>' + v + '</li>';
				});
				// aria-describedby="val-username-error" aria-invalid="true"
				control.after('<div class="help-block animation-pullUp">' + message + '</div>');


			});
			// scroll to first error
			$('html, body').animate({
	    		scrollTop: $('.has-error:first').offset().top -40
			}, 1000);
		}
	}
	else
	{
		alert(msg);
	}

}

function ReloadContainer(container)
{
	window.location.reload();
}

function responsive_filemanager_callback(field_id){
	var url=jQuery('#'+field_id).val();
	var matches = url.match(/\/source\/(.*)/);

	if (window['GalleryMode'] && GalleryMode)
	{
		GalleryMode = false;
		SendAjax(AddImageUrl, 'POST', {gallery_id:GalleryID, path:matches[1], model:Model, model_id:ModelID});
	}
	else
	{
		$('#' + field_id).val(matches[1]);
	}
	return false;
}

function ClearValidationMessages(form)
{
	$.each(form.find('.has-error'), function( index, error_block ) {

		$(error_block).removeClass('has-error');
		$(error_block).find('.help-block').remove();

	});
	
}

$(function(){

	// show modal
	$('body').on('click', '.ajax_modal', function(e){

		e.preventDefault();
		$('#modal-fade').remove();
		$.ajax({

		    url: $(this).attr('href'),

		    success: function(newHTML, textStatus, jqXHR) {
		      $(newHTML).appendTo('body');
		      $('#modal-fade').modal();
		      // App.init();
		      InitControls($('#modal-fade'));
		      InitDialogsControls();
		    },

		    error: function(jqXHR, textStatus, errorThrown) {
		      // Handle AJAX errors
		    }

		    // More AJAX customization goes here.

		 });

	});

	// submit modal form
	$('body').on('submit', '.modal form', function(e) {

		e.preventDefault();
		ClearValidationMessages($(this));
		SendAjax($(this).attr('action'), $(this).attr('method'), $(this).serialize(), function(){$('.modal').modal('hide'); ReloadContainer()});

	});

	$('body').on('submit', 'form.form-edit', function(e) {

		e.preventDefault();
		// clear validation messages
		ClearValidationMessages($(this));
		SendAjax($(this).attr('action'), $(this).attr('method'), $(this).serialize());

	});


 	$('.filemanager_jamp').fancybox({	
		'width'		: 900,
		'height'	: 600,
		'type'		: 'iframe',
	    'autoScale'    	: false
    });

    $('body').on('click', 'a.ajax-delete, a.ajax-deactivate, a.ajax-destroyever, a.ajax-restore, a.ajax-activate', function(e){
    	e.preventDefault();
    	SendAjax($(this).attr('href'), 'PUT');

    });

 	$('body').on('change', 'input[type=checkbox].checkbox-control', function(e){
    	e.preventDefault();
    	 var hidden_control = $(this).parents('.form-group').find('input[name=' + $(this).attr('id') + ']')
    	 var val = 0;
    	 if ($(this).is(':checked'))
    	 {
    	 	val = 1;
    	 }

    	 hidden_control.val(val);
    });

    tinymce_conf = {
        height: 400,
        plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor code"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true ,
       
        external_filemanager_path:"/backend/filemanager/",
        filemanager_access_key:js_strings.filemanager.apkey ,
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "/backend/filemanager/plugin.min.js"},
        selector: "textarea.editor",
        forced_root_block : "", 
        force_br_newlines : true,
        force_p_newlines : false,
        valid_elements: '*[*]',
		extended_valid_elements: '*[*]'
    };      

    tinymce_conf_readonly = {
        height: 400,
        plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor"
        ],
        toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        image_advtab: true ,
       
        external_filemanager_path:"/backend/filemanager/",
        filemanager_title:"Responsive Filemanager" ,
        external_plugins: { "filemanager" : "/backend/filemanager/plugin.min.js"},
        selector: "textarea.editor_disabled",
        readonly: true,
        forced_root_block : "", 
        force_br_newlines : true,
        force_p_newlines : false,
        valid_elements: '*[*]',
		extended_valid_elements: '*[*]'
    };

    tinymce.init(tinymce_conf);
    tinymce.init(tinymce_conf_readonly);

});

/*
var InitUI = function(el) {

 	$.fn.tooltip && $('[rel="tooltip"]', el).tooltip();

 	$.fn.prettyPhoto && $("a[rel^='prettyPhoto']", el).prettyPhoto({social_tools:false});

 	$('.more').find('label').prepend('<span class="ui-icon ui-icon-plusthick" style="float:left; margin-right:5px;"></span>');
 	
	$('.more').each( function() {
		var group = $(this).data("group");
		$('.'+ group).hide();
	});
	
	$('.more').click(function() {
		var group = $(this).data("group");
		$('.'+ group).toggle();
		if ($(this).find('label span').attr("class") == "ui-icon ui-icon-plusthick") newClass = 'ui-icon ui-icon-minusthick';
		else newClass =  'ui-icon ui-icon-plusthick';
		$(this).find('label span').removeClass().addClass(newClass);
	});
}
*/