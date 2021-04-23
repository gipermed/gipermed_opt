<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->RestartBuffer();
unset($arResult["COMBO"]);

if ( $arParams[ "IS_MANUAL_SECTION" ] == "Y" ) {
	$arResult["REAL_CNT"] = $APPLICATION->IncludeComponent(
		"gipermed:smart.filter.real.cnt",
		"",
		array(
			"IBLOCK_ID" => $arParams[ "IBLOCK_ID" ],
			"FILTER_NAME" => $arParams[ "FILTER_NAME" ],
			"CACHE_TIME" => $arParams[ "CACHE_TIME" ]
		)
	);

	$arResult["FILTER"] = $GLOBALS["arrFilter"];
}

echo CUtil::PHPToJSObject($arResult, true);
?>