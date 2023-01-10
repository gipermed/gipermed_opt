<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$arResult['MAP_BALLOON'] = array();
if ($arResult['DELIVERY_POINTS']) {
	foreach($arResult['DELIVERY_POINTS'] as &$arPoint) {
		$addressFieldCode = (in_array($arPoint["TYPE"], array(
			\Grastin\Delivery\Selfpickup\Settings::SELF_PICKUP,
			\Grastin\Delivery\Selfpickup\Settings::PARTNER_SELF_PICKUP,
		)) && $arPoint["TITLE"]) ? "TITLE" : "NAME";

		$arPoint['NAME'] = htmlspecialcharsbx($arPoint[$addressFieldCode]);
		$arResult['MAP_BALLOON'][] = array(
			"ID" => $arPoint['ID'],
			"XML_ID" => $arPoint['XML_ID'],
			"TITLE" => $arPoint['NAME'],
			"ADDRESS" => $arPoint['NAME'],
			"PHONE" => $arPoint['PHONE'],
			"TIME_WORK" => $arPoint['TIMETABLE'],
			"DRIVINGDESCRIPTION" => $arPoint['DRIVINGDESCRIPTION'],
			"COORD" => [$arPoint['LATITUDE'], $arPoint['LONGITUDE']]
		);
	}
}