<?php

class Backend_FaqCategoriesController extends Backend_BackendController {

	public $model_name = 'FaqCategory';
	/**
	 * Display a listing of the resource.
	 * GET /faqcategories
	 *
	 * @return Response
	 */
	public function index()
	{
		// redirect to first faqcategories lists
		if ($category = FaqCategory::backend()->order()->first())
		{
			return \Redirect::action('Backend_FaqCategoriesController@show', $category->id);
		}
		else
		{
			return View::make('backend.faq_categories.show');
		}

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /faqcategories/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$category = new FaqCategory;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.faq_categories.create', compact('category', 'allow_tabs', 'tab'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /faqcategories
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		$last = FaqCategory::search(array('order' => array('order', 'desc')), 1);
		$input['order'] = $last ? $last->order + 1 : 0;
		return FaqCategory::modelSave(null, $input);
	}

	/**
	 * Display the specified resource.
	 * GET /faqcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$active_category = FaqCategory::backend()->find($id);
		$categories = FaqCategory::backend()->order()->get();

		return View::make('backend.faq_categories.show', compact('active_category', 'categories'));
	}

	protected function edit_initialize($id, &$data)
	{
		$allow_tabs = array('edit');
		if (!in_array($data['tab'], $allow_tabs)) return false;
		$category = FaqCategory::backend()->find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['category'] = $category;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /faqcategories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.faq_categories.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /faqcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		return FaqCategory::modelSave($id, $input);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /faqcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function change_status($id, $status)
	{
		$model = $this->model_name;
		$ret = $model::modelSave($id, array('status' => $status));
		$ret['redirect'] = $status == 2 ? action('Backend_FaqCategoriesController@index') : \URL::previous();
		return $ret;
	}

}