<?php

class Backend_TeamsController extends Backend_BackendController {

	public $model_name = 'Team';
	/**
	 * Display a listing of the resource.
	 * GET /teams
	 *
	 * @return Response
	 */
	public function index()
	{
		$teams = Team::backend()->order()->get();
		return View::make('backend.teams.index', compact('teams'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /teams/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$team = new Team;
		$allow_tabs = array('create');
		$tab = 'create';
		return View::make('backend.teams.create', compact('team', 'allow_tabs', 'tab'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /teams
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::get();
		$last = Team::search(array('order' => array('order', 'desc')), 1);
		$input['order'] = $last ? $last->order + 1 : 0;
		return Team::modelSave(null, $input);
	}

	/**
	 * Display the specified resource.
	 * GET /teams/{id}
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
		$team = Team::backend()->find($id);

		$data['allow_tabs'] = $allow_tabs;
		$data['team'] = $team;

		return true;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /teams/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data = array('tab' => 'edit', 'language_mode' => true);
		if (!$this->edit_initialize($id, $data)) return $this->response404();
		return View::make('backend.teams.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /teams/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::get();
		return Team::modelSave($id, $input);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /teams/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}