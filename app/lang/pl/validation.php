<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute musi być zaakceptowany.",
	"active_url"           => ":attribute nie jest prawidłowym adresem URL.",
	"after"                => ":attribute musi być datą po :date.",
	"alpha"                => ":attribute może zawierać tylko litery.",
	"alpha_dash"           => ":attribute może zawierać tylko litery, liczby i kreski.",
	"alpha_num"            => ":attribute może zawierać tylko litery i liczby.",
	"array"                => ":attribute musi być tablicą.",
	"before"               => ":attribute musi być datą przed :date.",
	"between"              => array(
		"numeric" => ":attribute musi być pomiędzy :min, a :max.",
		"file"    => ":attribute musi być pomiędzy :min, a :max kb.",
		"string"  => ":attribute musi być pomiędzy :min, a :max znaków.",
		"array"   => ":attribute musi być pomiędzy :min, a :max sztuk.",
	),
	"confirmed"            => ":attribute potwierdzenie nie pasuje.",
	"date"                 => ":attribute nie jest prawidłową datą.",
	"date_format"          => ":attribute nie pasuje do formatu :format.",
	"different"            => ":attribute i :other muszą być różne.",
	"digits"               => ":attribute musi być :digits digits.",
	"digits_between"       => ":attribute musi być pomiędzy :min, a :max digits.",
	"email"                => ":attribute musi być prawidłowy adres e-mail.",
	"exists"               => "selected :attribute jest niepoprawny.",
	"image"                => ":attribute musi być zdjęciem.",
	"in"                   => "selected :attribute jest niepoprawny.",
	"integer"              => ":attribute musi być liczbą.",
	"ip"                   => ":attribute musi być poprawny adres IP.",
	"max"                  => array(
		"numeric" => ":attribute nie może mieć więcej niż :max.",
		"file"    => ":attribute nie może mieć więcej niż :max kb.",
		"string"  => ":attribute nie może mieć więcej niż :max znaków.",
		"array"   => ":attribute nie może mieć więcej niż :max sztuk.",
	),
	"mimes"                => ":attribute musi być plikiem o typie: :values.",
	"min"                  => array(
		"numeric" => ":attribute musi mieć przynajmniej :min.",
		"file"    => ":attribute musi mieć przynajmniej :min kb.",
		"string"  => ":attribute musi mieć przynajmniej :min znaków.",
		"array"   => ":attribute musi miec przynajmniej :min sztuk.",
	),
	"not_in"               => "selected :attribute jest niepoprawny.",
	"numeric"              => ":attribute musi być liczbą.",
	// "regex"                => ":attribute format jest niepoprawny.",
	"regex"                => "Format jest niepoprawny.",
	// "required"             => ":attribute jest wymagany.",
	"required"             => "Pole jest wymagane.",
	"required_if"          => ":attribute jest wymagany, kiedy :other jest :value.",
	"required_with"        => ":attribute jest wymagany, kiedy :values jest obecny.",
	"required_with_all"    => ":attribute jest wymagany, kiedy :values jest obecny.",
	"required_without"     => ":attribute jest wymagany, kiedy :values nie jest obecny.",
	"required_without_all" => ":attribute jest wymagany, kiedy żadna :values nie jest obecna.",
	"same"                 => ":attribute and :other must match.",
	"size"                 => array(
		"numeric" => ":attribute musi mieć :size.",
		"file"    => ":attribute musi mieć :size kb.",
		"string"  => ":attribute musi mieć :size znaków.",
		"array"   => ":attribute musi zawierać :size sztuk.",
	),
	// "unique"               => ":attribute już istnieje.",
	"unique"               => "Podana wartość już istnieje.",
	"url"                  => ":attribute format jest niepoprawny.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
