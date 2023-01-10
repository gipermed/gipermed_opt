<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ( $arResult[ "SECTIONS" ] as $i => &$arSection ) {
	$arSection["SECTION_PAGE_URL"] = getCatalogSectionUrl($arSection["ID"]);

	if ( $arSection["ELEMENT_CNT"] <= 0 ) continue;

	$idParent = $arSection[ "IBLOCK_SECTION_ID" ] ?: "ROOT";
	$id = $arSection[ "ID" ];
	$arResult[ "TREE" ][ $idParent ][] = $id;
	$arResult[ "INDEXES" ][ $id ] = $i;



	$arImg = CFile::ResizeImageGet(
		$arSection[ "PICTURE" ][ "ID" ],
		array( "width" => 208, "height" => 208 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);

	$arSection[ "PICTURE" ][ "SRC" ] = $arImg[ "src" ];
}