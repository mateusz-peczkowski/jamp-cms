<?php $articles = $global_page->connection('Article') ? : false; ?>
@if($articles AND sizeof($articles))
	@foreach($articles as $article)
		@include('frontend.articles.'.($article->viewinc ? : 'default'))
	@endforeach
@endif