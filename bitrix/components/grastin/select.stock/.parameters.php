<?

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

Loc::loadMessages(__FILE__);

$arComponentParameters = array(
	/*"GROUPS" => array(
		"ACTION_SETTINGS" => array(
			"NAME" => GetMessage('IBLOCK_ACTIONS')
		)
	),*/
	"PARAMETERS" => array(
		"DELIVERY" => array(
			"NAME" => Loc::getMessage("GD_PARAM_SELECT_STOCK_F_DELIVERY_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => ""
		),
		"POINT_ID" => array(
			"NAME" => Loc::getMessage("GD_PARAM_SELECT_STOCK_F_DELIVERY_POINT_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => ""
		),
		"USE_SEARCH_RADIUS" => array(
			"NAME" => Loc::getMessage("GD_PARAM_SELECT_STOCK_F_USE_SEARCH_RADIUS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y"
		),
		"LOCATION" => array(
			"NAME" => Loc::getMessage("GD_PARAM_SELECT_STOCK_F_LOCATION"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"CITY" => array(
			"NAME" => Loc::getMessage("GD_PARAM_SELECT_STOCK_F_CITY"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		)
	),
);