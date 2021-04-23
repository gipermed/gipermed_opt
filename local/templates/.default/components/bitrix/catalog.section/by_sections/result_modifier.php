<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$tableName = 'b_hlbd_prodcountry'; // Похуй

$arResize = array(
	"SIZE" => array( "width" => 26, "height" => 18 ),
	"TYPE" => BX_RESIZE_IMAGE_PROPORTIONAL_ALT
);

$arResult[ "COUNTRIES" ] = getDirPropertyList( $tableName, array(), $arResize );

$sort = $arParams["SECTION_SORT_FIELD"];
$rs = CIBlockSection::GetList(
	array( $sort => "ASC" ),
	array( "IBLOCK_ID" => $arParams[ "IBLOCK_ID" ] ),
	false,
	array( "ID", "IBLOCK_ID", "IBLOCK_SECTION_ID" , "NAME", $sort )
);

$arSections = array();

while ($row = $rs->GetNext()) {
	$arSections[ $row[ "ID" ] ] = $row;
}



$arResult[ "ITEMS_IN_SECTIONS" ] = [];

foreach ( $arResult[ "ITEMS" ] as $i => &$arItem ) {
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


	$productSections = getCatalogProductSections($arItem["ID"]);

	foreach($productSections as $sectionId) {
		while ( true ) {
			$parent = $arSections[ $sectionId ][ "IBLOCK_SECTION_ID" ];

			if ( $parent != ROOT_SECTION_ID ) {
				$sectionId = $parent;
				if ( !$sectionId ) break;
			}
			else {
				$ar = &$arResult[ "ITEMS_IN_SECTIONS" ][ $sectionId ];
				if ( !is_array($ar) )  $ar = [];
				if ( count($ar) < 20 ) $ar[] = $i;

				$sortIndex = $arSections[ $sectionId ][ $sort ];
				if ( (int)$sortIndex > 0 ) {
					$arSections[ $sectionId ][ "DISPLAY" ] = "Y";
				}

				break 2;
			}
		}
	}


	$arCountries = $arItem[ "PROPERTIES" ][ "PROD_COUNTRY" ][ "VALUE" ];
	if ( is_array($arCountries) ) {
		foreach ( $arItem[ "PROPERTIES" ][ "PROD_COUNTRY" ][ "VALUE" ] as $code ) {
			$arItem["COUNTRIES"][$code] = $arResult["COUNTRIES"][$code];
		}
	}
}

$arResult[ "SECTIONS" ] = $arSections;
