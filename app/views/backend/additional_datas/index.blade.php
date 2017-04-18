<?php
if ($obj->connection('Profile'))
{
	echo JForm::FormOpen(action('Backend_AdditionalDatasController@update_all'), 'POST');
    $profile = $obj->connection('Profile')->first();
	echo JForm::Hidden('model', $obj::ModelName());
	echo JForm::Hidden('record', $obj->id);
    foreach ($profile->def('additional_data') as $field_name => $field_data)
    {
        $additional_data = AdditionalData::search(array('model' => $obj::ModelName(), 'record' => $obj->id, 'name' => $field_name), 1);
        $disabled = (isset($field_data['translation']) && !$field_data['translation'] && Backend::IsTranslation());
    	echo str_replace('AdditionalData__value', $field_name, JForm::{$field_data['type']}('AdditionalData__value', $additional_data, array('label' => $field_data['title'], 'disabled' => $disabled)));
    }
    echo JForm::FormButtons();
	echo JForm::FormClose();
}
?>