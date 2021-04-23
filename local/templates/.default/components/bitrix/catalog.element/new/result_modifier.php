<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult["ALT_PAGE_URL"] = getCatalogProductUrl($arResult["ID"], true);

$arImages = $arResult["PROPERTIES"]["ADDITIONAL_PHOTO"]["VALUE"];

if ( $arResult["DETAIL_PICTURE"] )
	array_unshift ( $arImages, $arResult["DETAIL_PICTURE"]["ID"] );


if ( is_array($arImages) ) {
	foreach ($arImages as $imgId) {

		$arImgBig = CFile::ResizeImageGet(
			$imgId,
			array("width" => 428, "height" => 387),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT
		);

		$arImgSmall = CFile::ResizeImageGet(
			$imgId,
			array("width" => 78, "height" => 69),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT
		);
		$arImgMedium = CFile::ResizeImageGet(
			$imgId,
			array("width" => 256, "height" => 256),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT
		);

		$arResult["IMG"][] = array(
			"BIG" => $arImgBig["src"],
			"SMALL" => $arImgSmall["src"],
			"MEDIUM" => $arImgMedium["src"],
			"ORIGINAL" => CFile::GetPath($imgId)
		);
	}
}


$arImgSmall = CFile::ResizeImageGet(
	$arResult["DETAIL_PICTURE"] ? $arResult["DETAIL_PICTURE"]["ID"] : $arImages[0],
	array( "width" => 62, "height" => 56 ),
	BX_RESIZE_IMAGE_PROPORTIONAL_ALT
);

$arResult[ "STICKY_IMG" ] = $arImgSmall["src"];



$arResult["ICONS"] = getCatalogIconColor( $arResult["PROPERTIES"] );


$arMeasureUnits = array(
	GetMessage("CT_MU_B"),
	GetMessage("CT_MU_KB"),
	GetMessage("CT_MU_MB"),
);

$arDocs = $arResult[ "PROPERTIES" ][ "DOCS" ][ "VALUE" ];
if ( is_array($arDocs) && count($arDocs) ) {
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
if ( is_array($arManufacturers) ) {
	foreach ($arManufacturers as $manufacturerId) {
		$rs = CIBlockElement::GetList(
			[],
			["ID" => $manufacturerId],
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

		if ($row = $rs->GetNext()) {
			$imgId =
				$row["PREVIEW_PICTURE"] ?:
					$row["DETAIL_PICTURE"];


			if ($imgId) {
				$arImg = CFile::ResizeImageGet(
					$imgId,
					array("width" => 120, "height" => 40),
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT
				);

				$arCountryCodes[] = $row["PROPERTY_COUNTRY_VALUE"];

				$arResult["MANUFACTURERS"][] = array(
					"NAME" => $row["NAME"],
					"URL" => $row["DETAIL_PAGE_URL"],
					"SRC" => $arImg["src"],
					"COUNTRY" => $row["PROPERTY_COUNTRY_VALUE"]
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

$newPrice = $arResult["ITEM_PRICES"][0]["PRICE"];

if ( $newPrice ) {
	$arResult["PRICES"]["NEW"] = \CCurrencyLang::CurrencyFormat( $newPrice, "RUB" );
	$arResult["PRICES"]["NEW_RAW"] = $newPrice;

	$oldPrice = floatval($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]);
	if ( $oldPrice && $newPrice < $oldPrice ) {
		$arResult["PRICES"]["OLD"] = \CCurrencyLang::CurrencyFormat( $arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"], "RUB" );
		$arResult["PRICES"]["DISCOUNT"] = intval( 100 - 100 * $newPrice / $oldPrice ) * (-1);
	}
}

$video = $arResult[ "PROPERTIES" ][ "VIDEO_CODE" ][ "~VALUE" ];
if ( $video ) {
	$video = preg_replace('/width="\d+"/', '', $video);
	$video = preg_replace('/height="\d+"/', '', $video);
	$arResult["VIDEO_CODE"] = $video;
}


$giftActive = $arResult["PROPERTIES"]["OFFER_GIFT_ACTIVE"]["VALUE"];
$giftFrom = MakeTimeStamp($arResult["PROPERTIES"]["OFFER_GIFT_ACTIVE_FROM"]["VALUE"]);
$giftTo   = MakeTimeStamp($arResult["PROPERTIES"]["OFFER_GIFT_ACTIVE_TO"]["VALUE"]);
$gifts = $arResult["PROPERTIES"]["OFFER_GIFT_PRODUCTS"]["VALUE"];
$arResult["GIFT"] = $giftActive &&
	( $giftFrom <= time() || !$giftFrom ) &&
	( $giftTo 	>= time() || !$giftTo 	) &&
	is_array($gifts) &&
	count($gifts);



$cp = $this->__component;
if (is_object($cp)) {
	$cp->arResult["SIMILAR"] = $arResult[ "PROPERTIES" ][ "SIMILAR_PRODUCTS" ][ "VALUE" ];
	$cp->arResult["RELATED"] = $arResult[ "PROPERTIES" ][ "RELATED_PRODUCTS" ][ "VALUE" ];
	$cp->setResultCacheKeys(array("SIMILAR", "RELATED"));
}
