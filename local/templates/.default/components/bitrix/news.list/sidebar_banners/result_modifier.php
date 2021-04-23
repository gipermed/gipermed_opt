<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["SIDE"]["LEFT"] = [];
$arResult["SIDE"]["RIGHT"] = [];
foreach ( $arResult[ "ITEMS" ] as &$arItem ) {
	if ($arItem["PROPERTIES"]["SITE"]["VALUE"] == "Розница") continue;

	$imgId = $arItem[ "PREVIEW_PICTURE" ]
		? $arItem[ "PREVIEW_PICTURE" ][ "ID" ]
		: $arItem[ "DETAIL_PICTURE" ][ "ID" ];

	$arImg = CFile::ResizeImageGet(
		$imgId,
		array( "width" => 9999, "height" => 192 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);

	$arItem[ "IMG" ] = $arImg[ "src" ];


	switch ( $arItem["PROPERTIES"]["POSITION"]["VALUE"] ) {
		case "Слева": 	$arResult["SIDE"]["LEFT" ][] = $arItem; break;
		case "Справа": 	$arResult["SIDE"]["RIGHT"][] = $arItem; break;
		default: break;
	}
}
