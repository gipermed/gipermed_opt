<?

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => Loc::getMessage("GD_ORDER_SHIPMENT_EDIT_TEMPLATE_NAME"),
	"DESCRIPTION" => Loc::getMessage("GD_ORDER_SHIPMENT_EDIT_TEMPLATE_DESCRIPTION"),
	"ICON" => "/images/ico.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 50,
	"PATH" => array(
		"ID" => Loc::getMessage("GRASTIN_DELIVERY_ID"),
		"NAME" => Loc::getMessage("GRASTIN_DELIVERY_PATHNAME"),
	),
);
?>