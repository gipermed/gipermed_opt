<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ( $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] )
	$APPLICATION->SetPageProperty("description", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]);

$GLOBALS[ "filterSimilar" ][ "ID" ] = $arResult[ "SIMILAR" ] ?: false;
$GLOBALS[ "filterRelated" ][ "ID" ] = $arResult[ "RELATED" ] ?: false;

?>
<script>
	$(function () {
		$(".js-product").val(window.location.href);
	});
</script>
<div style="display: none">
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	".default",
	array(
		"DESC" => $arResult[ "NAME" ],
		"CLASS" => "cost-modal",
		"COMPONENT_TEMPLATE" => ".default",
		"WEB_FORM_ID" => "2",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	".default",
	array(
		"DESC" => $arResult[ "NAME" ],
		"CLASS" => "contact-manager",
		"COMPONENT_TEMPLATE" => ".default",
		"WEB_FORM_ID" => "3",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);
?>
</div>