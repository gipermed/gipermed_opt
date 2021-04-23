<?

$newPrice = $arResult["ITEM_PRICES"][0]["PRICE"];
if ( $newPrice ) {
	$arResult["PRICES"]["NEW"] = \CCurrencyLang::CurrencyFormat( $newPrice, "RUB" );

	$oldPrice = floatval($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]);
	if ( $oldPrice && $newPrice < $oldPrice ) {
		$arResult["PRICES"]["OLD"] = \CCurrencyLang::CurrencyFormat( $arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"], "RUB" );
		$arResult["PRICES"]["DISCOUNT"] = intval( 100 - 100 * $newPrice / $oldPrice ) * (-1);
	}
}
$urls = getCatalogProductUrl($arResult["ID"]);
$arResult["DETAIL_PAGE_URL"] = $urls["curr"];
$arResult["ALT_PAGE_URL"] = $urls["alt"];

$giftActive = $arResult["PROPERTIES"]["OFFER_GIFT_ACTIVE"]["VALUE"];
$giftFrom = MakeTimeStamp($arResult["PROPERTIES"]["OFFER_GIFT_ACTIVE_FROM"]["VALUE"]);
$giftTo   = MakeTimeStamp($arResult["PROPERTIES"]["OFFER_GIFT_ACTIVE_TO"]["VALUE"]);
$gifts = $arResult["PROPERTIES"]["OFFER_GIFT_PRODUCTS"]["VALUE"];
$arResult["GIFT"] = $giftActive &&
	( $giftFrom <= time() || !$giftFrom ) &&
	( $giftTo 	>= time() || !$giftTo 	) &&
	is_array($gifts) &&
	count($gifts);