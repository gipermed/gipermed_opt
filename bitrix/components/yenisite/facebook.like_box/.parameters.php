<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(

	"PARAMETERS" => array(
		"PAGE_URL" =>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("PAGE_URL"),
			"TYPE" => "STRING",
			"DEFAULT" => "http://www.facebook.com/platform",
		),
		"WIDTH" =>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("WIDTH"),
			"TYPE" => "STRING",
			"DEFAULT" => "292",
		),
		"HEIGHT" =>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("HEIGHT"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"FACES" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("FACES"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"COLOR_SCHEME" =>array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("COLOR_SCHEME"),
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => array(
				'light' => GetMessage("COLOR_SCHEME_LIGHT"),
				'dark' => GetMessage("COLOR_SCHEME_DARK"),
			),
			"DEFAULT" => 'NEW',
		),
		"STREAM" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("STREAM"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"BORDER" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("BORDER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"HEADER" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("HEADER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);
?>