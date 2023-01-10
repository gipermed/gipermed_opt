<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ( $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] )
	$APPLICATION->SetPageProperty("description", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]);
?>