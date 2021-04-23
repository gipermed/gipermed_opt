<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CCatalogSimilar extends CBitrixComponent {
	const CACHE_PATH =  "/" . SITE_ID . "/gipermed/" . __CLASS__  . "/";

	public function onPrepareComponentParams($arParams)	{
		$arParams[ "ID" ] = (int)$arParams[ "ID" ];
		$arParams[ "IBLOCK_ID" ] = (int)$arParams[ "IBLOCK_ID" ];
		$arParams[ "CACHE_TIME" ] = (int)$arParams[ "CACHE_TIME" ];

		if ( !$arParams[ "FILTER_NAME" ] )
			$arParams[ "FILTER_NAME" ] = "arrFilter";

		return $arParams;
	}

	public function executeComponent() {
		$val =  $this->getResultCached();

		$GLOBALS[ $this->arParams[ "FILTER_NAME" ] ] = array( "ID" => $val );
	}


	private function getResultCached() {
		$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cacheTtl = $this->arParams["CACHE_TIME"];
		$cacheId = md5( $this->arParams[ "ID" ] . "_" . $this->arParams[ "PROP_CODE" ] );
		$cachePath = self::CACHE_PATH;

		$value = array();


		if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
			$value = $cache->getVars();
		}
		elseif ($cache->startDataCache()) {
			$value = $this->getResult();

			$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
			$cache_manager->startTagCache($cachePath);
			$cache_manager->registerTag("iblock_id_" . $this->arParams["IBLOCK_ID"]);
			$cache_manager->endTagCache();

			$cache->endDataCache($value);
		}

		return $value;
	}

	private function getResult() {
		\CModule::IncludeModule('iblock');

		$propCode =  "PROPERTY_" . $this->arParams[ "PROP_CODE" ];

		$rs = \CIBlockElement::GetList(
			array(),
			array(
				"ID" => $this->arParams[ "ID" ],
				"IBLOCK_ID" => $this->arParams[ "IBLOCK_ID" ],
			),
			false,
			false,
			array( $propCode )
		);

		$ar = array();
		while ($el = $rs->GetNext())
			$ar[] = $el[ $propCode . "_VALUE" ];

		return $ar;
	}
}