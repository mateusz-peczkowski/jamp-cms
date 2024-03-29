@extends('frontend.emails.emails')

<?php 
	$domain = Request::root() ? substr (Request::root(), 7) : false;
?>

@section('body')
Dziękujemy za wypełnienie naszego formularza kontaktowego.<br /><br /><br />
Poniżej przedstawiamy zapytanie jakie zostało do nas przesłane z Pana/i adresu e-mail poprzez formularz na stronie internetowej {{ $domain }}<br /><br /><br />
Na zadane pytania odpowiemy naszybciej jak możemy!<br /><br /><br />
<table cellspacing="0" cellpadding="0" width="500" bgcolor="#ffffff" border="0" style="margin: 0 auto;">
	@foreach($submit->form->controls as $control)
	<tr>
		<td style="vertical-align: top; text-align: right; width: 50%; font: bold 12px/120% Verdana,sans-serif; margin: 0px; padding: 0 10px 0 0; color: #000;">
			{{ $control->label }}:
		</td>
		<td style="vertical-align: top; text-align: left; font: normal 12px/120% Verdana,sans-serif; margin: 0px; color: #666;">
			{{ $submit->submitdata($control->name) }}
		</td>
	</tr>
	@endforeach
</table>
@endsection