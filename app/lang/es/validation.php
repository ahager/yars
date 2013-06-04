<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => ":attribute tiene que ser aceptado.",
	"active_url"       => ":attribute no es una URL válida.",
	"after"            => ":attribute tiene que ser una fecha posterior a :date.",
	"alpha"            => ":attribute sólo puede tener letras.",
	"alpha_dash"       => ":attribute  sólo puede tener letras, números, y guiones.",
	"alpha_num"        => ":attribute sólo puede tener letras y números.",
	"before"           => ":attribute debe ser una fecha anterior a :date.",
	"between"          => array(
		"numeric" => ":attribute debe ser entre :min - :max.",
		"file"    => ":attribute debe ser entre :min - :max kilobytes.",
		"string"  => ":attribute debe ser de :min a :max caracteres de largo.",
	),
	"confirmed"        => "La confirmación de :attribute no coincide.",
	"date"             => ":attribute no es una fecha válida.",
	"date_format"      => ":attribute no tiene el formato :format.",
	"different"        => ":attribute y :other deben ser distintos.",
	"digits"           => ":attribute debe ser de :digits dígitos.",
	"digits_between"   => ":attribute debe ser de :min a :max dígitos.",
	"email"            => "El formato de :attribute es inválido.",
	"exists"           => "El :attribute seleccionado es inválido.",
	"image"            => ":attribute debe ser una imagen.",
	"in"               => "El :attribute seleccionado is inválido.",
	"integer"          => ":attribute debe ser un número entero.",
	"ip"               => ":attribute debe ser una dirección IP válida.",
	"max"              => array(
		"numeric" => ":attribute no puede ser mayor a :max.",
		"file"    => ":attribute no puede ser mayor a :max kilobytes.",
		"string"  => ":attribute no puede ser mayor a :max caracteres de largo.",
	),
	"mimes"            => ":attribute debe ser un archivo de tipo: :values.",
	"min"              => array(
		"numeric" => ":attribute debe ser al menos :min.",
		"file"    => ":attribute debe ser de al menos :min kilobytes.",
		"string"  => ":attribute debe ser de al menos :min caracteres de largo.",
	),
	"not_in"           => ":attribute seleccionado es inválido.",
	"numeric"          => ":attribute debe ser un número.",
	"regex"            => ":attribute tiene un formato inválido.",
	"required"         => ":attribute es requerido.",
	"required_if"      => ":attribute es requerido cuando :other es :value.",
	"required_with"    => ":attribute es requerido cuando hay :values.",
	"required_without" => ":attribute es requerido cuando no hay :values.",
	"same"             => ":attribute y :other deben coincidir.",
	"size"             => array(
		"numeric" => ":attribute debe ser de :size.",
		"file"    => ":attribute debe ser de :size kilobytes.",
		"string"  => ":attribute debe ser de :size caracteres de largo.",
	),
	"unique"           => ":attribute ya está registrado.",
	"url"              => ":attribute no tiene un formato válido.",

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

	'custom' => array(),

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

	'attributes' => array(
		'first_name' => 'Nombre',
		'last_name' => 'Apellido',
		'male' => 'Masculino',
		'female' => 'Femenino',
		'nin' => 'DNI',

	),

);
