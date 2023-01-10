<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ( $arResult[ "ITEMS" ] as &$arItem ) {
	$arImgBig = CFile::ResizeImageGet(
		$arItem[ "DETAIL_PICTURE" ][ "ID" ],
		array( "width" => 800, "height" => 269 ),
		BX_RESIZE_IMAGE_EXACT
	);

	$arImgSmall = CFile::ResizeImageGet(
		$arItem[ "PREVIEW_PICTURE" ][ "ID" ],
		array( "width" => 320, "height" => 455 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);

	$arItem[ "BIG_IMG" ] = $arImgBig[ "src" ];
	$arItem[ "SMALL_IMG" ] = $arImgSmall[ "src" ];
}
