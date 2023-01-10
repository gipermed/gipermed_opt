<?
define("DISABLE_HEADER_FLOAT", "Y");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');


\Bitrix\Main\Loader::includeModule('iblock');

if (empty($_REQUEST['ID'])) {
	$_REQUEST['ID'] = \Bitrix\Iblock\ElementTable::getRow([
		'filter' => ['=CODE' => $_REQUEST['ELEMENT_CODE']],
		'select' => ['ID'],
		'cache' => ['ttl' => 60 * 60 * 24 * 30 * 6],
	])['ID'];

	if (empty($_REQUEST['ID'])) {
		$_REQUEST['ID'] = $_REQUEST['ELEMENT_CODE'];
	}
}

$correctUrl = getCatalogProductUrl($_REQUEST["ID"], true);
$currUrl = explode("?", $_SERVER["REQUEST_URI"])[0];

if ($GLOBALS["USER"]->IsAdmin()) {
//	var_dump(explode("?", $_SERVER["REQUEST_URI"])[0]);
//	var_dump($correctUrl);
}

if ( $currUrl && $correctUrl && $currUrl != $correctUrl ) {
	\Bitrix\Main\Diag\Debug::writeToFile($correctUrl, $currUrl, "_____urlredirect.log");
	//LocalRedirect($correctUrl, false, "301 Moved permanently");
}


$arUrl = explode( "/", $_REQUEST[ "SECTION_PATH" ] );
$sectionCode = "";

while ( count($arUrl) > 0 && $sectionCode == "" ) {
	$sectionCode = array_pop($arUrl);
}
?>
<div class="page page-product page-product--padding">
	<div class="page-container">
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"",
			Array(
				"PATH" => "",
				"SITE_ID" => SITE_ID,
				"START_FROM" => "0"
			)
		);?>
		<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.element", 
	"new", 
	array(
		"SHOW_OLD_PRICE" => "Y",
		"COMPONENT_TEMPLATE" => "new",
		"IBLOCK_TYPE" => "ru",
		"IBLOCK_ID" => "1",
		"ELEMENT_ID" => $_REQUEST["ID"],
		"ELEMENT_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_CODE" => $sectionCode,
		"SHOW_DEACTIVATED" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"PROPERTY_CODE" => array(
			0 => "ART_NUMBER",
			1 => "MANUFACTURER",
			2 => "",
		),
		"OFFERS_LIMIT" => "0",
		"BACKGROUND_IMAGE" => "-",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"SECTION_ID_VARIABLE" => "",
		"CHECK_SECTION_ID_VARIABLE" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "N",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "N",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"DISPLAY_COMPARE" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_GIFTS_DETAIL" => "N",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"SET_VIEWED_IN_COMPONENT" => "N"
	),
	false
);?>

		<?  if ( unpublishedProductsMustBeHidden() ) $GLOBALS[ "filterRelated" ][ "!PROPERTY_PUBLISH" ] = false; ?>
		<? $GLOBALS["filterRelated"]["!PROPERTY_PUBLISH_RETAIL"] = false; ?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"related_new",
			array(
				"TARGET_ID" => $_REQUEST["ID"],
				"IBLOCK_TYPE" => "ru",
				"IBLOCK_ID" => "1",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER2" => "desc",
				"PROPERTY_CODE" => array(
					0 => "ART_NUMBER",
					1 => "",
				),
				"PROPERTY_CODE_MOBILE" => "",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"BASKET_URL" => "",
				"ACTION_VARIABLE" => "",
				"PRODUCT_ID_VARIABLE" => "",
				"SECTION_ID_VARIABLE" => "",
				"PRODUCT_QUANTITY_VARIABLE" => "",
				"PRODUCT_PROPS_VARIABLE" => "",
				"FILTER_NAME" => "filterRelated",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"SET_TITLE" => "Y",
				"MESSAGE_404" => "",
				"SET_STATUS_404" => "Y",
				"SHOW_404" => "N",
				"FILE_404" => "",
				"DISPLAY_COMPARE" => "N",
				"PAGE_ELEMENT_COUNT" => "300",
				"LINE_ELEMENT_COUNT" => "3",
				"PRICE_CODE" => array(
					0 => "BASE",
				),
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "",
				"PRICE_VAT_INCLUDE" => "Y",
				"USE_PRODUCT_QUANTITY" => "N",
				"ADD_PROPERTIES_TO_BASKET" => "N",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRODUCT_PROPERTIES" => array(
				),
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_BASE_LINK" => "",
				"PAGER_PARAMS_NAME" => "",
				"LAZY_LOAD" => "",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"CONVERT_CURRENCY" => "N",
				"BRAND_PROPERTY" => "",
				"TEMPLATE_THEME" => "",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "",
				"SHOW_CLOSE_POPUP" => "",
				"COMPARE_PATH" => "",
				"COMPARE_NAME" => "",
				"USE_COMPARE_LIST" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"COMPATIBLE_MODE" => "N",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"COMPONENT_TEMPLATE" => "catalog",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SHOW_ALL_WO_SECTION" => "Y",
				"CUSTOM_FILTER" => "",
				"SEF_MODE" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N"
			),
			false
		);?>

		<?  if ( unpublishedProductsMustBeHidden() ) $GLOBALS[ "filterSimilar" ][ "!PROPERTY_PUBLISH" ] = false; ?>
		<? $GLOBALS["filterSimilar"]["!PROPERTY_PUBLISH_RETAIL"] = false; ?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"similar_new",
			array(
				"TARGET_ID" => $_REQUEST["ID"],
				"IBLOCK_TYPE" => "ru",
				"IBLOCK_ID" => "1",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER2" => "desc",
				"PROPERTY_CODE" => array(
					0 => "ART_NUMBER",
					1 => "",
				),
				"PROPERTY_CODE_MOBILE" => "",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"BASKET_URL" => "",
				"ACTION_VARIABLE" => "",
				"PRODUCT_ID_VARIABLE" => "",
				"SECTION_ID_VARIABLE" => "",
				"PRODUCT_QUANTITY_VARIABLE" => "",
				"PRODUCT_PROPS_VARIABLE" => "",
				"FILTER_NAME" => "filterSimilar",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"SET_TITLE" => "Y",
				"MESSAGE_404" => "",
				"SET_STATUS_404" => "Y",
				"SHOW_404" => "N",
				"FILE_404" => "",
				"DISPLAY_COMPARE" => "N",
				"PAGE_ELEMENT_COUNT" => "300",
				"LINE_ELEMENT_COUNT" => "3",
				"PRICE_CODE" => array(
					0 => "BASE",
				),
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "",
				"PRICE_VAT_INCLUDE" => "Y",
				"USE_PRODUCT_QUANTITY" => "N",
				"ADD_PROPERTIES_TO_BASKET" => "N",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRODUCT_PROPERTIES" => array(
				),
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_BASE_LINK" => "",
				"PAGER_PARAMS_NAME" => "",
				"LAZY_LOAD" => "",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"CONVERT_CURRENCY" => "N",
				"BRAND_PROPERTY" => "",
				"TEMPLATE_THEME" => "",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "",
				"SHOW_CLOSE_POPUP" => "",
				"COMPARE_PATH" => "",
				"COMPARE_NAME" => "",
				"USE_COMPARE_LIST" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"COMPATIBLE_MODE" => "N",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"COMPONENT_TEMPLATE" => "catalog",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"SHOW_ALL_WO_SECTION" => "Y",
				"CUSTOM_FILTER" => "",
				"SEF_MODE" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SECTION_ID" => "",
				"SECTION_CODE" => "",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N"
			),
			false
		);?>
	</div>
</div>
<div id="modal-request" class="popup modal-request">
	<div class="popup-body">
		<div class="popup-head">
			<div class="popup-title">Запросить счёт</div>
			<a href="#" class="modal-close-btn" aria-label="Закрыть">
				<svg width="14" height="14"><use xlink:href="#icon-close"/></svg>
			</a>
		</div>
		<div class="popup-content">
			<?$APPLICATION->IncludeComponent(
				"bitrix:form.result.new",
				"ajax",
				array(
					"AJAX_MODE" => "Y", 
			       	"AJAX_OPTION_SHADOW" => "N", 
			       	"AJAX_OPTION_JUMP" => "Y", 
			       	"AJAX_OPTION_STYLE" => "Y", 
			       	"AJAX_OPTION_HISTORY" => "N", 
					"COMPONENT_TEMPLATE" => "ajax",
					"WEB_FORM_ID" => 2,
					"IGNORE_CUSTOM_TEMPLATE" => "N",
					"USE_EXTENDED_ERRORS" => "N",
					"SEF_MODE" => "N",
					"CACHE_TYPE" => "N",
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
			);?>
		</div>
	</div>
</div>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>
