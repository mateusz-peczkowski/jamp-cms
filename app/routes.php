<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// cmsbackend
Route::get('cmsbackend', 'Backend_LoginController@index');
Route::post('cmsbackend', 'Backend_LoginController@login');

Route::group(array('prefix' => 'cmsbackend', 'before' => 'auth'), function()
{

	Route::get('logout', 'Backend_LoginController@logout');

	Route::resource('pages', 'Backend_PagesController');
	Route::get('pages/{id}/galleries', 'Backend_PagesController@galleries');
	Route::get('pages/{id}/articles', 'Backend_PagesController@articles');
	Route::get('pages/{id}/meta', 'Backend_PagesController@meta');
	Route::get('pages/{id}/additional_data', 'Backend_PagesController@additional_data');
	Route::get('pages/{id}/advanced', 'Backend_PagesController@advanced');
	Route::put('pages/{id}/activate', 'Backend_PagesController@activate');
	Route::put('pages/{id}/deactivate', 'Backend_PagesController@deactivate');
	Route::put('pages/{id}/delete', 'Backend_PagesController@delete');
	Route::put('pages/{id}/destroyever', 'Backend_PagesController@destroyever');
	Route::get('pages/{id}/check_delete', 'Backend_PagesController@check_delete');

	Route::resource('navigations', 'Backend_NavigationsController');
	Route::post('navigations/{id}/refreshtree', 'Backend_NavigationsController@refreshTree');
	Route::resource('nodes', 'Backend_NodesController');
	
	Route::resource('gallery', 'Backend_GalleriesController');
	Route::post('gallery/{id}/sortable_medias', 'Backend_GalleriesController@sortable_medias');

	Route::resource('gallerymedia', 'Backend_GalleryMediasController');

	Route::resource('connections', 'Backend_ConnectionsController');
	Route::put('connections/{model1}/{record1}/{model2}/{record2}', 'Backend_ConnectionsController@delete_connection');
	Route::post('connections/sortable/{model1}/{record1}/{model2}', 'Backend_ConnectionsController@sortable_connection');
	Route::get('connections/create_connection/{model1}/{record1}/{model2}', 'Backend_ConnectionsController@create_connection');
	Route::post('connections/store_connection/{model1}/{record1}/{model2}', 'Backend_ConnectionsController@store_connection');

	Route::resource('articles', 'Backend_ArticlesController');
	Route::get('articles/{id}/galleries', 'Backend_ArticlesController@galleries');
	Route::get('articles/{id}/additional_data', 'Backend_ArticlesController@additional_data');
	Route::put('articles/{id}/activate', 'Backend_ArticlesController@activate');
	Route::put('articles/{id}/deactivate', 'Backend_ArticlesController@deactivate');
	Route::put('articles/{id}/delete', 'Backend_ArticlesController@delete');
	Route::put('articles/{id}/destroyever', 'Backend_ArticlesController@destroyever');

	Route::resource('modredirects', 'Backend_ModredirectsController', array('only' => array('index')));
	Route::get('modredirects/json_data', 'Backend_ModredirectsController@json_data');
	Route::post('modredirects/save', 'Backend_ModredirectsController@save');
	
	Route::resource('languagekey', 'Backend_LanguageKeysController', array('except' => array('edit', 'show')));
	Route::get('languagekey/json_data', 'Backend_LanguageKeysController@json_data');
	Route::post('languagekey/save', 'Backend_LanguageKeysController@save');


	Route::resource('defaults', 'Backend_DefaultsController', array('only' => array('index', 'update')));
	Route::get('defaults/meta', 'Backend_DefaultsController@meta');

	Route::resource('additional_datas', 'Backend_AdditionalDatasController');
	Route::post('additional_datas/update_all', 'Backend_AdditionalDatasController@update_all');

	// modules
	Route::resource('news', 'Backend_NewsController');
	Route::get('news/sortable', 'Backend_NewsController@sortable');
	Route::get('news/{id}/galleries', 'Backend_NewsController@galleries');
	Route::put('news/{id}/activate', 'Backend_NewsController@activate');
	Route::put('news/{id}/deactivate', 'Backend_NewsController@deactivate');
	Route::put('news/{id}/delete', 'Backend_NewsController@delete');	
	Route::put('news/{id}/destroyever', 'Backend_NewsController@destroyever');

	Route::resource('press', 'Backend_PressesController');
	Route::put('press/{id}/activate', 'Backend_PressesController@activate');
	Route::put('press/{id}/deactivate', 'Backend_PressesController@deactivate');
	Route::put('press/{id}/delete', 'Backend_PressesController@delete');
	Route::put('press/{id}/destroyever', 'Backend_PressesController@destroyever');

	Route::resource('partners', 'Backend_PartnersController');
	Route::post('partner/sortable', 'Backend_PartnersController@sortable');
	Route::put('partners/{id}/activate', 'Backend_PartnersController@activate');
	Route::put('partners/{id}/deactivate', 'Backend_PartnersController@deactivate');
	Route::put('partners/{id}/delete', 'Backend_PartnersController@delete');
	Route::put('partners/{id}/destroyever', 'Backend_PartnersController@destroyever');

	Route::resource('products', 'Backend_ProductsController');
	Route::post('product/sortable', 'Backend_ProductsController@sortable');
	Route::put('products/{id}/activate', 'Backend_ProductsController@activate');
	Route::put('products/{id}/deactivate', 'Backend_ProductsController@deactivate');
	Route::put('products/{id}/delete', 'Backend_ProductsController@delete');
	Route::put('products/{id}/destroyever', 'Backend_ProductsController@destroyever');

	Route::resource('team', 'Backend_TeamsController');
	Route::post('team/sortable', 'Backend_TeamsController@sortable');
	Route::put('team/{id}/activate', 'Backend_TeamsController@activate');
	Route::put('team/{id}/deactivate', 'Backend_TeamsController@deactivate');
	Route::put('team/{id}/delete', 'Backend_TeamsController@delete');
	Route::put('team/{id}/destroyever', 'Backend_TeamsController@destroyever');

	Route::resource('faqcategory', 'Backend_FaqCategoriesController');
	Route::post('faqcategory/sortable', 'Backend_FaqCategoriesController@sortable');
	Route::put('faqcategory/{id}/activate', 'Backend_FaqCategoriesController@activate');
	Route::put('faqcategory/{id}/deactivate', 'Backend_FaqCategoriesController@deactivate');
	Route::put('faqcategory/{id}/delete', 'Backend_FaqCategoriesController@delete');
	Route::put('faqcategory/{id}/destroyever', 'Backend_FaqCategoriesController@destroyever');

	Route::resource('faq', 'Backend_FaqsController');
	Route::put('faq/{id}/activate', 'Backend_FaqsController@activate');
	Route::put('faq/{id}/deactivate', 'Backend_FaqsController@deactivate');
	Route::put('faq/{id}/delete', 'Backend_FaqsController@delete');
	Route::put('faq/{id}/destroyever', 'Backend_FaqsController@destroyever');

	// trash
	Route::resource('trash', 'Backend_TrashController');

	// forms
	Route::resource('forms', 'Backend_FormsController', array('except' => array('index', 'show')));
	Route::get('forms/{id}', 'Backend_FormsController@index');
	Route::get('forms/{id}/controls', 'Backend_FormsController@controls');
	Route::put('forms/{id}/activate', 'Backend_FormsController@activate');
	Route::put('forms/{id}/deactivate', 'Backend_FormsController@deactivate');
	Route::put('forms/{id}/delete', 'Backend_FormsController@delete');

	Route::resource('forms/{id}/controls', 'Backend_FormControlsController', array('except' => array('index')));
	Route::post('forms/{form_id}/controls/sortable', 'Backend_FormControlsController@sortable');
	Route::put('forms/controls/{id}/activate', 'Backend_FormControlsController@activate');
	Route::put('forms/controls/{id}/deactivate', 'Backend_FormControlsController@deactivate');
	Route::put('forms/controls/{id}/delete', 'Backend_FormControlsController@delete');

	Route::resource('formsubmits', 'Backend_FormSubmitsController', array('only' => array(/*'index',*/ 'show')));
	Route::get('formsubmits/form/{form_id}', 'Backend_FormSubmitsController@index');

});

try 
{
	foreach (\Config::get('app.locales') as $locale)
	{
		$conf = array();
		if ($locale != Language::defaultLanguage())
		{
			$conf['prefix'] = $locale;
		}
		
		Route::group($conf, function() use ($conf, $locale){

			if ($module_page = Page::active()->tag('News')->first())
			{
				Route::get($module_page->url . '/{slug}', function($slug) use ($module_page) {

					return CMS::render('Frontend_NewsController@show', array($slug), array('page' =>  $module_page, 'view' => 'news.show'));

				});
			}

			if ($module_page = Page::active()->tag('Press')->first())
			{
				Route::get($module_page->url . '/{slug}', function($slug) use ($module_page) {

					return CMS::render('Frontend_PressesController@show', array($slug), array('page' =>  $module_page, 'view' => 'presses.show'));

				});
			}

			Route::post('forms/submit/{tag}', 'Frontend_FormsController@store');

			// js translations
			Route::get('js/trans.js','Frontend_GenericController@jsTranslation');

		});

	}

	Route::any('{slug}', function($slug){

		return CMS::resolveUrl($slug);

	})->where('slug', '([A-z\d-\/_.]+)?');

}
catch (Exception $e)
{	
}




