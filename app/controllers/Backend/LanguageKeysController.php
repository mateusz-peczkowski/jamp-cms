<?php

class Backend_LanguageKeysController extends Backend_BackendController {

	public function index()
	{
		return View::make('backend.languagekeys.index');
	}

	public function json_data()
	{
		$data = $this->getKeys();
		if (!$data) $data[] = array("", "");
		return Response::json(array('data' => $data));
	}

	protected function getKeys()
	{
		$languageKeys = LanguageKey::backend()->get();
		$ret = array();

		foreach ($languageKeys as $languageKey)
		{
			$row = array(
				'id' =>	$languageKey->id,
				'key' =>	$languageKey->key,
				'value' =>	$languageKey->value,
				);
			if (Backend::IsTranslation())
			{
				$row['original'] = $languageKey['original']['value'];
			}
			
			$ret[] = (object) $row;
		}
		return $ret;
	}

	public function save()
	{
		// because Input::get() only form data
		$input = json_decode(file_get_contents("php://input"), true);
		if (isset($input['data']))
		{
			$languageKeys = LanguageKey::backend()->lists('value', 'id');
			foreach ($input['data'] as $languageKey)
			{
				if (isset($languageKey['id']) && $languageKey['id'] && isset($languageKey['value']) && $languageKey['value'])
				{
					if (isset($languageKeys[$languageKey['id']]))
					{
						// update
						LanguageKey::modelSave($languageKey['id'], array('language' => \Input::get('language'), 'value' => $languageKey['value']), array('redirect' => action('Backend_LanguageKeysController@index')));
					}
				}
			}
			// clear cache
			$this->clearCache();

			return array(
				'status' => 'OK',
				'message' => trans('backend.updated'),
				'action' => 'UPDATE'
				);
		}
		else
		{
			return \Response::json(array("result" => "ok"));
		}
	}

	public function create()
	{
		$languageKey = new LanguageKey;
		return View::make('backend.languagekeys.create', compact('languageKey'));
	}



	public function store()
	{
		$input = \Input::get();
		$ret = LanguageKey::modelSave(null, $input, array('redirect' => action('Backend_LanguageKeysController@index')));
		$this->clearCache();
		return $ret;
	}

	
	public function destroy($id)
	{
		//
	}

	// clear cache language translations
	public function clearCache()
	{
		\Cache::forget(CMS::getLanguageKeysCacheKey());
		// 	when base language version clear cache in all languages
		if (!Backend::IsTranslation())
		{
			foreach (Language::backend()->get() as $language)
			{
				\Cache::forget(CMS::getLanguageKeysCacheKey($language->title));
			}
		}
	}

}