@extends('frontend.emails.emails')

@section('body')
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