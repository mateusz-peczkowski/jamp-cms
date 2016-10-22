<?php

class Backend_GalleriesController extends Backend_BackendController {

	/**
	 * Display a listing of the resource.
	 * GET /nodes
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /nodes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /nodes
	 *
	 * @return Response
	 */
	public function store()
	{
		
	}

	/**
	 * Display the specified resource.
	 * GET /nodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /nodes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /nodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /nodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

	public function sortable_medias($id)
	{
		$order = json_decode(\Input::get('ids'));

		$gallery_medias = DB::table('gallery_medias')
			->where('gallery_id', '=', $id)
			->get();

		foreach ($gallery_medias as $gallery_media)
		{
			DB::table('gallery_medias')
            ->where('id', '=', $gallery_media->id)
            ->update(array('order' => array_search($gallery_media->id, $order)));
		}
		return $this->responseOK(false);
	}

}