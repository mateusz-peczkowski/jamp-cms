<?php

class Backend_FaqsController extends Backend_BackendController {

	public $model_name = 'Faq';
	/**
	 * Display a listing of the resource.
	 * GET /faqs
	 *
	 * @return Response
	 */
	public function index()
	{
		$faqs = Faq::backend()->order()->get();
		return View::make('backend.faqs.index', compact('faqs'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /faqs/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$faq = new Faq;
		$category = $faq->connected('FaqCategory', 0, 1);
		if (\Input::get('category_id'))
		{
			$category->id = \Input::get('category_id');
		}

		$allow_tabs = array('create');
		$tab = 'create';

		$categories = FaqCategory::backend()->get();

		return View::make('backend.faqs.create', compact('faq', 'allow_tabs', 'tab', 'category', 'categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /faqs
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		// $last = Faq::search(array('order' => array('order', 'desc')), 1);
		// $input['order'] = $last ? $last->order + 1 : 0;
		$ret = Faq::modelSave(null, $input);

		// connection
		if (\Input::has('FaqCategory__id') && $ret['status'] == 'OK')
		{
			$connection_data['model1']	= 'FaqCategory';
			$connection_data['record1']	= \Input::get('FaqCategory__id');
			$connection_data['model2']	= $this->model_name;
			$connection_data['record2']	= $ret['object']->id;
			Connection::replace_connection($connection_data);
		}
		return $ret;
	}

	/**
	 * Display the specified resource.
	 * GET /faqs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	protected function edit_initialize($id, &$data)
	{
		$allow_tabs = array('edit');
		if (!in_array($data['tab'], $allow_tabs)) return false;
		$faq = Faq::backend()->find($id);
		$categories = FaqCategory::backend()->get();
		$category = $faq->connected('FaqCategory', 0, 1);

		$data['allow_tabs'] = $allow_tabs;
		$data['faq'] = $faq;
		$data['category'] = $category;
		$data['categories'] = $categories;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /faqs/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.faqs.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /faqs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		$ret = Faq::modelSave($id, $input);

		// connection
		if (\Input::has('FaqCategory__id') && $ret['status'] == 'OK')
		{
			$connection_data['model1']	= 'FaqCategory';
			$connection_data['record1']	= \Input::get('FaqCategory__id');
			$connection_data['model2']	= $this->model_name;
			$connection_data['record2']	= $id;
			Connection::replace_connection($connection_data);
		}
		return $ret;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /faqs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}