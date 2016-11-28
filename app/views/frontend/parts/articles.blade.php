<?php 
	$articles = $global_page->connection('Article') ? : false; 
	$checkNums = (object) [];
	foreach($articlespaths as $path) {
		$title = $path->title;
		$checkNums->$title = 1;
	}
?>
@if($articles AND sizeof($articles))
	@foreach($articles as $article)
		<?php 
			$view = ($article->viewinc ? : 'default');
			$checknum = $checkNums->$view;
		?>
		@include('frontend.articles.'.$view)
		<?php 
			if ($checkNums->$view) {
				$checkNums->$view = $checkNums->$view+1;
			} else {
				$checkNums->$view = 1;
			}
		?>
	@endforeach
@endif