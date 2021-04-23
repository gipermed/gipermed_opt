<?

$newPrice = floatval($arResult["PROPERTIES"]["PRICE_WHOLESALE"]["VALUE"]);
if ( $newPrice ) {
	$arResult["PRICES"]["NEW"] = \CCurrencyLang::CurrencyFormat( $newPrice, "RUB" );

	$oldPrice = floatval($arResult["PROPERTIES"]["PRICE_WHOLESALE_OLD"]["VALUE"]);
	if ( $oldPrice && $newPrice < $oldPrice ) {
		$arResult["PRICES"]["OLD"] = \CCurrencyLang::CurrencyFormat( $oldPrice, "RUB" );
		$arResult["PRICES"]["DISCOUNT"] = intval( 100 - 100 * $newPrice / $oldPrice ) * (-1);
	}
}



$expPrice = $arResult["PROPERTIES"]["EXP_PRICE"]["VALUE"];
$expDate = strtotime( $arResult["PROPERTIES"]["EXP_DATE"]["VALUE"] );


if ( $expPrice && $expDate && $expDate >= time() ) {
	$arResult["EXP_DATE"] = date( "m.Y", $expDate );
	$arResult["EXP_PRICE"] = $expPrice;
}

$urls = getCatalogProductUrl($arResult["ID"]);
$arResult["DETAIL_PAGE_URL"] = $urls["curr"];
$arResult["ALT_PAGE_URL"] = $urls["alt"];


