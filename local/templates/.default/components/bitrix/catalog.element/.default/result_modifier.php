<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["ALT_PAGE_URL"] = getCatalogProductUrl($arResult["ID"], true);

$arImages = $arResult["PROPERTIES"]["ADDITIONAL_PHOTO"]["VALUE"];

if ( $arResult["DETAIL_PICTURE"] )
	array_unshift ( $arImages, $arResult["DETAIL_PICTURE"]["ID"] );


foreach ( $arImages as $imgId ) {

	$arImgBig = CFile::ResizeImageGet(
		$imgId,
		array( "width" => 428, "height" => 387 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);

	$arImgSmall = CFile::ResizeImageGet(
		$imgId,
		array( "width" => 78, "height" => 69 ),
		BX_RESIZE_IMAGE_PROPORTIONAL_ALT
	);


	$arResult[ "IMG" ][] = array(
		"BIG" => $arImgBig[ "src" ],
		"SMALL" => $arImgSmall[ "src" ],
		"ORIGINAL" => CFile::GetPath($imgId)
	);
}

$arResult["ICONS"] = getCatalogIconColor( $arResult["PROPERTIES"] );


$expPrice = $arResult["PROPERTIES"]["EXP_PRICE"]["VALUE"];
$expDate = strtotime( $arResult["PROPERTIES"]["EXP_DATE"]["VALUE"] );


if ( $expPrice && $expDate && $expDate >= time() ) {
	$arResult["EXP_DATE"] = date( "m/y", $expDate );
	$arResult["EXP_PRICE"] = $expPrice;
}

$arMeasureUnits = array(
	GetMessage("CT_MU_B"),
	GetMessage("CT_MU_KB"),
	GetMessage("CT_MU_MB"),
);

$arDocs = $arResult[ "PROPERTIES" ][ "DOCS" ][ "VALUE" ];
if ( is_array($arDocs) && count($arDocs) > 0 ) {
	foreach ( $arDocs as $fileId ) {
		$arFile = CFile::GetFileArray( $fileId );

		$arFile[ "ORIGINAL_NAME" ] = preg_replace(
			'/\.[a-zA-Z]{3,4}$/',
			"",
			$arFile[ "ORIGINAL_NAME" ]
		);


		$size = $arFile[ "FILE_SIZE" ];
		$measureUnit = 0;

		while ( $size > 1024 ) {
			$size = ceil( $size / 1024 );
			$measureUnit++;
		}

		$measureUnit = $arMeasureUnits[ $measureUnit ];
		$arFile[ "FILE_SIZE" ] = "$size $measureUnit";

		$arResult["DOCS"][] = $arFile;
	}
}


$arCountryCodes = array();

$arManufacturers = $arResult[ "PROPERTIES" ][ "MANUFACTURER" ][ "VALUE" ];

if (is_array($arManufacturers)) {
	foreach ( $arManufacturers as $manufacturerId ) {
		$rs = CIBlockElement::GetList(
			[],
			[ "ID" => $manufacturerId ],
			false,
			false,
			[
				"ID",
				"NAME",
				"DETAIL_PAGE_URL",
				"PREVIEW_PICTURE",
				"DETAIL_PICTURE",
				"PROPERTY_COUNTRY"
			]
		);

		if ( $row = $rs->GetNext() ) {
			$imgId =
				$row[ "PREVIEW_PICTURE" ] ?:
					$row[ "DETAIL_PICTURE" ];


			if ( $imgId ) {
				$arImg = CFile::ResizeImageGet(
					$imgId,
					array( "width" => 120, "height" => 40 ),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT
				);

				$arCountryCodes[] = $row[ "PROPERTY_COUNTRY_VALUE" ];

				$arResult[ "MANUFACTURERS" ][] = array(
					"NAME" => $row[ "NAME" ],
					"URL" => $row[ "DETAIL_PAGE_URL" ],
					"SRC" => $arImg[ "src" ],
					"COUNTRY" => $row[ "PROPERTY_COUNTRY_VALUE" ]
				);
			}
		}
	}
}




$tableName = $arResult[ "PROPERTIES" ][ "PROD_COUNTRY" ][ "USER_TYPE_SETTINGS" ][ "TABLE_NAME" ];
$arResize = array(
	"SIZE" => array( "width" => 26, "height" => 18 ),
	"TYPE" => BX_RESIZE_IMAGE_PROPORTIONAL_ALT
);

$arResult[ "COUNTRIES" ] = getDirPropertyList( $tableName, $arCountryCodes, $arResize );




$arResult["PRICES"] = array();
$newPrice = floatval($arResult["PROPERTIES"]["PRICE_WHOLESALE"]["VALUE"]);

if ( $newPrice ) {
	$arResult["PRICES"]["NEW"] = \CCurrencyLang::CurrencyFormat( $newPrice, "RUB" );

	$oldPrice = floatval($arResult["PROPERTIES"]["PRICE_WHOLESALE_OLD"]["VALUE"]);
	if ( $oldPrice && $newPrice < $oldPrice ) {
		$arResult["PRICES"]["OLD"] = \CCurrencyLang::CurrencyFormat( $oldPrice, "RUB" );
		$arResult["PRICES"]["DISCOUNT"] = intval( 100 - 100 * $newPrice / $oldPrice ) * (-1);
	}
}



$cp = $this->__component;
if (is_object($cp)) {
	$cp->arResult["SIMILAR"] = $arResult[ "PROPERTIES" ][ "SIMILAR_PRODUCTS" ][ "VALUE" ];
	$cp->arResult["RELATED"] = $arResult[ "PROPERTIES" ][ "RELATED_PRODUCTS" ][ "VALUE" ];
	$cp->setResultCacheKeys(array("SIMILAR", "RELATED"));
}
