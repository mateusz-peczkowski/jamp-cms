<?php

class Backend_ModredirectsController extends Backend_BackendController {

	public function index()
	{
		// $redirects = Modredirect::backend()->get();
		return View::make('backend.modredirects.index'/*, compact('redirects')*/);
	}

	public function json_data()
	{
		$data = array();
		$redirects = Modredirect::backend()->get();

		foreach ($redirects as $redirect)
		{
			$data[] = array($redirect->from_url, $redirect->to_url);	
		}

		if (!$data) $data[] = array("", "");

		return Response::json(array('data' => $data));
	}

	public function save()
	{
		// because Input::get() only form data
		$input = json_decode(file_get_contents("php://input"), true);
		if (isset($input['data']))
		{
			// clear all redirects
			DB::table('modredirects')->truncate();
			foreach ($input['data'] as $redirect)
			{
				if (isset($redirect[0]) && $redirect[0] && isset($redirect[1]) && $redirect[1])
				{
					$r = new Modredirect;
					$r->from_url = $redirect[0];
					$r->to_url = $redirect[1];
					$r->save();
				}
			}
			return array(
				'status' => 'OK',
				'message' => trans('backend.update'),
				'action' => 'UPDATE'
				);
		}
		else
		{
			return \Response::json(array("result" => "ok"));
		}
	}

	
	public function destroy($id)
	{
		//
	}
}