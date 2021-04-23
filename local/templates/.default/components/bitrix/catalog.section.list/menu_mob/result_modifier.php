<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ( $arResult[ "SECTIONS" ] as $i => &$arSection ) {
	if ( $arSection["ELEMENT_CNT"] <= 0 ) continue;

	$arSection["SECTION_PAGE_URL"] = getCatalogSectionUrl($arSection["ID"]);

	$idParent = $arSection[ "IBLOCK_SECTION_ID" ] ?: "ROOT";
	$id = $arSection[ "ID" ];
	$arResult[ "TREE" ][ $idParent ][] = $id;
	$arResult[ "INDEXES" ][ $id ] = $i;



	$arImg = CFile::ResizeImageGet(
		$arSection[ "DETAIL_PICTURE" ],
		array( "width" => 22, "height" => 30 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);

	$arSection[ "ICON" ] = $arImg[ "src" ];
}