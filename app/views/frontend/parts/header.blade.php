<?php $defaultpage = Page::byTag('default') ? : $global_page; ?> 
<header class="header">
	<div class="row extended">
		@if($homePage = Page::byTag('homePage'))
		<div class="xsmall-6 columns">
			<a href="/" title="{{ $defaultpage->data('site_name') }}" class="logo">
				<img src="/img/logo.png" alt="{{ $defaultpage->data('site_name') }}">
			</a>
		</div>
		@endif
	</div>
</header>