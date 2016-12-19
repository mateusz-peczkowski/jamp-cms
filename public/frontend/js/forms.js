$.fn.clearForm = function() {
	return this.each(function() {
		var type = this.type, tag = this.tagName.toLowerCase();
		if (tag == 'form')
			return $(':input',this).clearForm();
		if (type == 'text' || type == 'password' || tag == 'textarea' || type =='email' || type == 'date')
			this.value = '';
		else if (type == 'checkbox' || type == 'radio')
			this.checked = false;
		else if (tag == 'select')
			this.selectedIndex = -1;
	});
};


function sendForm(form)
{
	if($(form).hasClass('ajax') === true)
	{
		var $form = $(form);

		var url = $form.attr('action');
		var method = $form.attr('method')
		var data = $form.serialize();

		$form.find('.ajax-message .alert-danger').slideUp(250);
		$form.find('.ajax-message .alert-success').slideUp(250);

		$.ajax({
		  type: method,
		  timeout: 10000,
		  url: url,
		  data: data,
			beforeSend: function() {
				$form.find('button').attr("disabled", "disabled");
			},
			complete: function() {
				$form.find('button').removeAttr("disabled");
			},
			error: function(status) {
				if (status.statusText == 'timeout')
				{
					var msg = translations.forms.errors.timeout;	
				}
				else
				{
					var msg = translations.forms.errors.other;
				}
				
				$form.find('.ajax-message .alert-danger ul').html('<li>' + msg + '</li>');
				$form.find('.ajax-message .alert-danger').slideDown(250);
				$form.find('button').removeAttr("disabled");
			},
			success: function(response) {
				try
				{
					if (response.status == 1)
					{	
						if (response.redirect != null)
						{
							var dataAjax = $form.serializeArray();
							var string = '';
							$.each(dataAjax, function( key, value ) {
								if (value['name'] === 'lastsubmit') {
									value['value'] = response.lastsubmit ? '#'+response.lastsubmit : value['value'];
								}
					            string += '<input type="hidden" name="'+value['name']+'" value="'+value['value']+'">';
					        });
							var redirectform = $('<form action="' + response.redirect + '" method="post">'+ string +'</form>')
							$('body').append(redirectform);
							redirectform.submit();
						}
						else
						{
							var html = '';
							$.each(response.messages, function( index, value ){
								html += value;
							});
							$form.find('.ajax-message .alert-success').html(html);
							$form.find('.ajax-message .alert-success').slideDown(250);
							$form.clearForm();
						}
					}
					else
					{
						var html = '';
						$.each(response.messages, function( index, value ){
							html += '<li>' + value + '</li>'
						});

						$form.find('.ajax-message .alert-danger ul').html(html);
						$form.find('.ajax-message .alert-danger').slideDown(250);
					}
				}
				catch(err)
				{
					$form.find('.ajax-message .alert-danger ul').html('<li>' + translations.forms.errors.other + '</li>');
					$form.find('.ajax-message .alert-danger').slideDown(250);
					$form.find('button').removeAttr("disabled");
					$form.find('button').removeAttr("disabled");
				}
			}
		});
	}
	else
	{
		form.submit();
	}
}

$(document).ready(function() {

	$(document).on('submit', 'form.ajax', function (e) {
		e.preventDefault();
		sendForm(this);
	});
});