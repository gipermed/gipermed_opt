<?
	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
	$APPLICATION->SetTitle("Каталог");
	$APPLICATION->SetPageProperty("title", "Каталог");
	$url = $_SERVER['REQUEST_URI'];
	$url = explode('?', $url);
	$url = isset($_SERVER['HTTPS']) ? 'https://'.$_SERVER['SERVER_NAME'].$url[0] : 'http://' .$_SERVER['SERVER_NAME'].$url[0];
	$APPLICATION->AddHeadString('<link rel="canonical"  href="'.$url.'"/>');

	switch( $_REQUEST[ "COLLECTION_TYPE" ] ) {
		case "similar": $collectionPropCode = "SIMILAR_PRODUCTS"; break;
		case "related": $collectionPropCode = "RELATED_PRODUCTS"; break;
		default:		$collectionPropCode = false;
	}

	function getSmartFilterPathFromUrl(string $sefFolder, string $filterPath = 'filter/#SMART_FILTER_PATH#/apply/')
	{
		$sefFolder = trim($sefFolder, '/');
		$defaultTemplates = ["smart_filter" => $filterPath];
		$engine = new \CComponentEngine();
		if (\Bitrix\Main\Loader::includeModule('iblock')) {
			$engine->addGreedyPart("#SMART_FILTER_PATH#");
		}
		$urlTemplates = \CComponentEngine::makeComponentUrlTemplates($defaultTemplates, []);
		$engine->guessComponentPath(
			"/{$sefFolder}/",
			$urlTemplates,
			$variables
		);
		return $variables['SMART_FILTER_PATH'] ?: '';
	}

	if ( $collectionPropCode ) {
		$APPLICATION->IncludeComponent(
			"gipermed:catalog.similar",
			"",
			array(
				"FILTER_NAME" => "arrFilter",
				"IBLOCK_ID" => 1,
				"ID" => $_REQUEST[ "ID" ],
				"PROP_CODE" => $collectionPropCode,
				"CACHE_TIME" => 360000,
			),
			false
		);
	}
	else {
		$arManualSections = array(
			"sale" => array(
				"NAME" => "Распродажа",
				"CODE" => "SALE"
			),
			"stock" => array(
				"NAME" => "Акции",
				"CODE" => "STOCK"
			),
			"cut-price" => array(
				"NAME" => "Скидки",
				"CODE" => "REJECT"
			),
		);



		$sectionPath = $_REQUEST[ "SECTION_PATH" ];
		$manualSection = $arManualSections [ $sectionPath ];
		$sectionCode = "";

		if ( $manualSection ) {
			$APPLICATION->SetTitle( $manualSection[ "NAME" ] );
			$propCode = "PROPERTY_" . $manualSection[ "CODE" ];
			$GLOBALS[ "arrFilter" ][ "!$propCode" ] = false;
		}
		else {
			$arUrl = explode( "/", $sectionPath );

			while ( count($arUrl) > 0 && $sectionCode == "" ) {
				$sectionCode = array_pop($arUrl);
			}
		}
	}
?>
<div class="page page-catalog">
<div class="page-container">
<div class="category">
	<aside class="category-filter">
		<div class="category-filter-body">
			<div class="category-filter-head">
				<a href="#" class="category-filter-close-btn">
					<svg width="12" height="12"><use xlink:href="#icon-close"/></svg>
				</a>
				<div class="category-filter-head-title">Фильтр</div>
			</div>
			<!-- <div class="category-filter-title page-title">Анастезиология</div> -->
			<div class="category-filter-sections">
				<?if ( $manualSection ):?>
					<? //todo: что-нибудь с этим сделать ?>
					<?/*$APPLICATION->IncludeComponent(
						"gipermed:manual.section.list",
						"",
						array(
						"FILTER_NAME" => "arrFilter",
						"IBLOCK_ID" => 1,
						"SECTION_ID" => ROOT_SECTION_ID,
						"CACHE_TIME" => 360000,
						),
						false
					);/**/?>
					<?else:?>
					<?$APPLICATION->IncludeComponent(
							"bitrix:catalog.section.list",
							"catalog_left_menu_new",
							array(
								"IBLOCK_TYPE" => "ru",
								"IBLOCK_ID" => 1,
								"SECTION_ID" => $sectionCode ? "" : ROOT_SECTION_ID,
								"SECTION_CODE" => $sectionCode,
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => 360000,
								"CACHE_GROUPS" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"COUNT_ELEMENTS" => "Y",
								"TOP_DEPTH" => 1
							),
							false
						);?>
					<?endif?>

				<? if ( !$collectionPropCode ):?>
					<?$APPLICATION->IncludeComponent(
							"bitrix:catalog.smart.filter",
							"vertical_new",
							array(
								"IS_MANUAL_SECTION" => "Y",
								"IBLOCK_TYPE" => "ru",
								"IBLOCK_ID" => "1",
								"COMPONENT_TEMPLATE" => "vertical_new",
								"SECTION_ID" => $sectionCode ? "" : ROOT_SECTION_ID,
								"SECTION_CODE" => $sectionCode,
								"FILTER_NAME" => "arrFilter",
								"HIDE_NOT_AVAILABLE" => "N",
								"TEMPLATE_THEME" => "blue",
								"DISPLAY_ELEMENT_COUNT" => "N",
								"SEF_MODE" => "Y",
								"SEF_RULE" => "/catalog/#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
								"SMART_FILTER_PATH" => getSmartFilterPathFromUrl('catalog' . '/' . $sectionCode),
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_GROUPS" => "N",
								"SAVE_IN_SESSION" => "N",
								"PAGER_PARAMS_NAME" => "arrPager",
								"PRICE_CODE" => array(
									0 => "BASE",
								),
								"CONVERT_CURRENCY" => "N",
								"XML_EXPORT" => "N",
								"SECTION_TITLE" => "-",
								"SECTION_DESCRIPTION" => "-"
							),
							false
						);?>
					<?endif?>
			</div>
		</div>
	</aside>
	<div class="category-body">
		<?/*$arSort = $APPLICATION->IncludeComponent(
				"gipermed:catalog.sort.panel",
				"new",
				array(
					"SORT_DEF" => "popular",
					"SORT" => array(
						"popular" => array(
							"NAME" => "Популярность",
							"PARAM" => "show_counter",
							"DEF_DIR" => "DESC"
						),
						"price" => array(
							"NAME" => "Цена",
							"PARAM" => "CATALOG_PRICE_1",
							"DEF_DIR" => "ASC"
						),
					),
					"SHOW_BY" => array( 24, 36, 52 )
				),
				false
			);*/?>

		<?  if ( unpublishedProductsMustBeHidden() ) $GLOBALS[ "arrFilter" ][ "!PROPERTY_PUBLISH" ] = false; ?>
		<? $GLOBALS["arrFilter"]["!PROPERTY_PUBLISH_RETAIL"] = false;?>
		<?$intSectionID = $APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"catalog_new",
				array(
					"IBLOCK_TYPE" => "ru",
					"IBLOCK_ID" => "1",
					"ELEMENT_SORT_FIELD" => $arSort[ "SORT" ],
					"ELEMENT_SORT_ORDER" => $arSort[ "ORDER" ],
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
					"FILTER_NAME" => "arrFilter",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "N",
					"SET_TITLE" => "Y",
					"MESSAGE_404" => "",
					"SET_STATUS_404" => "Y",
					"SHOW_404" => "N",
					"FILE_404" => "",
					"DISPLAY_COMPARE" => "N",
					"PAGE_ELEMENT_COUNT" => $arSort[ "SHOW_BY" ],
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
					"ADD_SECTIONS_CHAIN" => "Y",
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
					"SET_BROWSER_TITLE" => "Y",
					"SET_META_KEYWORDS" => "Y",
					"SET_META_DESCRIPTION" => "Y",
					"SECTION_ID" => "",
					"SECTION_CODE" => $sectionCode,
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
						"COMPONENT_TEMPLATE" => ".default",
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
<?
	require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>