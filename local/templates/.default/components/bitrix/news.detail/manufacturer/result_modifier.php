<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$cp = $this->__component;
if (is_object($cp)) {
	$cp->arResult["SIMILAR"] = $arResult[ "PROPERTIES" ][ "SIMILAR" ][ "VALUE" ];
	$cp->setResultCacheKeys(array("SIMILAR"));
}

