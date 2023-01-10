<?

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => Loc::getMessage("GD_SELECT_STOCK_TEMPLATE_NAME"),
	"DESCRIPTION" => Loc::getMessage("GD_SELECT_STOCK_TEMPLATE_DESCRIPTION"),
	"CACHE_PATH" => "Y",
	"SORT" => 40,
	"PATH" => array(
		"ID" => "grastin",
		"NAME" => "Grastin",
	),
);

?>