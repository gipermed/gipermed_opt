<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	$APPLICATION->SetPageProperty("title", "Купить медицинские товары всех типов и размеров, цены, характеристики - интернет-магазин Гипермед.ру");
	$APPLICATION->SetTitle("Поиск");
?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:catalog.search", 
	//	".default",
	"search",
	array(
	"COMPONENT_TEMPLATE" => ".default",
	"IBLOCK_TYPE" => "ru",
	"IBLOCK_ID" => "1",
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER2" => "desc",
	"HIDE_NOT_AVAILABLE" => "N",
	"HIDE_NOT_AVAILABLE_OFFERS" => "N",
	"PAGE_ELEMENT_COUNT" => "30",
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" => array(
	0 => "PROD_COUNTRY",
	1 => "",
	),
	"OFFERS_LIMIT" => "5",
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"DISPLAY_COMPARE" => "N",
	"PRICE_CODE" => array(
	0 => "BASE",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"CONVERT_CURRENCY" => "N",
	"RESTART" => "N",
	"NO_WORD_LOGIC" => "N",
	"USE_LANGUAGE_GUESS" => "Y",
	"CHECK_DATES" => "N",
	"PAGER_TEMPLATE" => ".default",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N"
	),
	false
);*/?>

<div class="aside filter">
	<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"catalog_left_menu_new",
			array(
				"IBLOCK_TYPE" => "ru",
				"IBLOCK_ID" => 1,
				"SECTION_ID" => ROOT_SECTION_ID,
				"SECTION_CODE" => "",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => 360000,
				"CACHE_GROUPS" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"COUNT_ELEMENTS" => "Y",
				"TOP_DEPTH" => 1
			),
			false
		);?>
</div>


<div class="catalog-wrap">
	<div class="page-container">
		<?if($_REQUEST['q']) {   
				global $arrSearch;

				$arrSearch = array(
					'NAME' => '%'.$_REQUEST['q'].'%',
				);
			?>
			<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.section",
					"catalog_new",
					Array(
						"ACTION_VARIABLE" => "action",
						"ADD_PROPERTIES_TO_BASKET" => "N",
						"ADD_SECTIONS_CHAIN" => "N",
						"ADD_TO_BASKET_ACTION" => "ADD",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"BACKGROUND_IMAGE" => "-",
						"BASKET_URL" => "",
						"BROWSER_TITLE" => "-",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "N",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"COMPATIBLE_MODE" => "Y",
						"CONVERT_CURRENCY" => "N",
						"CUSTOM_FILTER" => "",
						"DETAIL_URL" => "",
						"DISABLE_INIT_JS_IN_COMPONENT" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"DISPLAY_COMPARE" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"ELEMENT_SORT_FIELD" => "sort",
						"ELEMENT_SORT_FIELD2" => "id",
						"ELEMENT_SORT_ORDER" => "asc",
						"ELEMENT_SORT_ORDER2" => "desc",
						"ENLARGE_PRODUCT" => "STRICT",
						"FILTER_NAME" => "arrSearch",
						"HIDE_NOT_AVAILABLE" => "N",
						"HIDE_NOT_AVAILABLE_OFFERS" => "N",
						"IBLOCK_ID" => "1",
						"IBLOCK_TYPE" => "ru",
						"INCLUDE_SUBSECTIONS" => "Y",
						"LAZY_LOAD" => "N",
						"LINE_ELEMENT_COUNT" => "3",
						"LOAD_ON_SCROLL" => "N",
						"MESSAGE_404" => "",
						"MESS_BTN_ADD_TO_BASKET" => "В корзину",
						"MESS_BTN_BUY" => "Купить",
						"MESS_BTN_DETAIL" => "Подробнее",
						"MESS_BTN_SUBSCRIBE" => "Подписаться",
						"MESS_NOT_AVAILABLE" => "Нет в наличии",
						"META_DESCRIPTION" => "-",
						"META_KEYWORDS" => "-",
						"OFFERS_LIMIT" => "5",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Товары",
						"PAGE_ELEMENT_COUNT" => "18",
						"PARTIAL_PRODUCT_PROPERTIES" => "N",
						"PRICE_CODE" => array("BASE"),
						"PRICE_VAT_INCLUDE" => "Y",
						"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
						"PRODUCT_ID_VARIABLE" => "id",
						"PRODUCT_PROPERTIES" => array(""),
						"PRODUCT_PROPS_VARIABLE" => "prop",
						"PRODUCT_QUANTITY_VARIABLE" => "quantity",
						"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
						"PRODUCT_SUBSCRIPTION" => "Y",
						"PROPERTY_CODE" => array("ART_NUMBER",""),
						"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
						"RCM_TYPE" => "personal",
						"SECTION_CODE" => "tovary-dlya-opta",
						"SECTION_ID" => "",
						"SECTION_ID_VARIABLE" => "SECTION_ID",
						"SECTION_URL" => "",
						"SECTION_USER_FIELDS" => array("",""),
						"SEF_MODE" => "N",
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SHOW_ALL_WO_SECTION" => "Y",
						"SHOW_CLOSE_POPUP" => "N",
						"SHOW_DISCOUNT_PERCENT" => "N",
						"SHOW_FROM_SECTION" => "N",
						"SHOW_MAX_QUANTITY" => "N",
						"SHOW_OLD_PRICE" => "N",
						"SHOW_PRICE_COUNT" => "1",
						"SHOW_SLIDER" => "Y",
						"TEMPLATE_THEME" => "blue",
						"USE_ENHANCED_ECOMMERCE" => "N",
						"USE_MAIN_ELEMENT_SECTION" => "N",
						"USE_PRICE_COUNT" => "N",
						"USE_PRODUCT_QUANTITY" => "N"
					)
				);?>
			<?}?>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>