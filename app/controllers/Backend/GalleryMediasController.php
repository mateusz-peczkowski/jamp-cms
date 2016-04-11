<?php

class Backend_GalleryMediasController extends Backend_BackendController {

	
	public function index()
	{
		//
	}

	
	public function create()
	{

	}

	
	public function store()
	{
		$params = \Input::only(array('gallery_id', 'path'));

		// recognize media type

		$file_path = public_path(\Config::get('app.media_path') . \Input::get('path'));
		if (file_exists($file_path))
		{
			$file = new Symfony\Component\HttpFoundation\File\File($file_path);
			$params['type'] = $file->getMimeType();
		}

		if (!$params['gallery_id'])
		{
			// new gallery mode
			$model_params = \Input::only('model', 'model_id');
			$model_name = $model_params['model'];
			$model_id = $model_params['model_id'];

			$object = $model_name::find($model_id);

			// create gallery
			$gallery = Gallery::modelSave(null, array('title' => $object->title));
			$gallery_object = $gallery['object'];
			$params['gallery_id'] = $gallery_object->id;

			// create relation to other model
			$element_galleries = array(
				'gallery_id'	=> $gallery_object->id,
				'model'			=>	$model_name,
				'model_id'		=>	$model_id,
				'order'			=>	0,
				);
			DB::table('element_galleries')->insert($element_galleries);

		}
		

		$last_media = GalleryMedia::search(array('gallery_id' => $params['gallery_id'], 'order' => array('order', 'desc')), 1);
		if ($last_media)
		{
			$params['order'] = $last_media->order + 1;
		}

		$ret = GalleryMedia::modelSave(null, $params);
		return $this->responseReload();
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		$media = GalleryMedia::backend()->find($id);
		return View::make('backend.gallerymedia.edit', compact('media'));
	}


	public function update($id)
	{
		$input = \Input::get();
		$ret = GalleryMedia::modelSave($id, $input);
		return $this->responseReload();
	}

	public function destroy($id)
	{
		$media = GalleryMedia::find($id);
		return ($media->delete()) ? $this->responseReload() : $this->responseError();
	}
}