<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ( $arResult[ "ITEMS" ] as &$arItem ) {
	$imgId = $arItem[ "PREVIEW_PICTURE" ]
		? $arItem[ "PREVIEW_PICTURE" ][ "ID" ]
		: $arItem[ "DETAIL_PICTURE" ][ "ID" ];

	$arImg = CFile::ResizeImageGet(
		$imgId,
		array( "width" => 180, "height" => 70 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);

	$arItem[ "SRC" ] = $arImg[ "src" ];
}
