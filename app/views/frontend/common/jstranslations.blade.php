global_translations = {{ json_encode($translations) }};
function getTranslation(key)
{
	return window['global_translations'][key];
}


