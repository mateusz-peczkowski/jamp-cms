<?php 
	$domain = Request::root() ? substr (Request::root(), 7) : false;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Wypełniono formularz kontaktowy na {{ $domain }}</title>
		<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
	</head>
	<body>

		<h1 style="text-align: center; font: bold 12px/120% Verdana,sans-serif; margin: 0 0 10px;">Wypełniono formularz na {{ $domain }}</h1>

		<div style="text-align: center; font: normal 12px/120% Verdana,sans-serif">
			<img src="http://{{ $domain }}/images/emailTemplate.jpg" width="500" height="150" alt="{{ $domain }}" style="display: block; margin: 20px auto; width: 500px; height: 150px; overflow: hidden;" />
			<div style="display: block; overflow: hidden; width: 100%; margin: 20px 0;">
				@yield('body')
			</div>
			<p style="text-align: center; margin-top: 30px;"><span style="font-size: x-small;"><strong>{{ $domain }}</strong></p>
		</div>

	</body>
</html>
