<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$tableName = 'b_hlbd_prodcountry'; // Похуй

$arResize = array(
	"SIZE" => array( "width" => 26, "height" => 18 ),
	"TYPE" => BX_RESIZE_IMAGE_PROPORTIONAL_ALT
);

$arResult[ "COUNTRIES" ] = getDirPropertyList( $tableName, array(), $arResize );

foreach ( $arResult[ "ITEMS" ] as &$arItem ) {
	$arItem["ICONS"] = getCatalogIconColor( $arItem["PROPERTIES"] );

	$imgId = $arItem[ "PREVIEW_PICTURE" ]
		? $arItem[ "PREVIEW_PICTURE" ][ "ID" ]
		: $arItem[ "DETAIL_PICTURE" ][ "ID" ];

	$arImg = CFile::ResizeImageGet(
		$imgId,
		array( "width" => 178, "height" => 118 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);

	$arItem[ "IMG" ] = $arImg[ "src" ];

	foreach ( $arItem[ "PROPERTIES" ][ "PROD_COUNTRY" ][ "VALUE" ] as $code ) {
		$arItem["COUNTRIES"][$code] = $arResult["COUNTRIES"][$code];
	}
}
