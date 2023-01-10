<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CSmartFilterRealCnt extends CBitrixComponent {
	const CACHE_PATH =  "/" . SITE_ID . "/gipermed/" . __CLASS__  . "/";
	private $filter = false;
	private $debug = true;

	public function onPrepareComponentParams($arParams)	{
		$arParams["IBLOCK_ID"] = (int)$arParams["IBLOCK_ID"];
		$arParams["CACHE_TIME"] = (int)$arParams["CACHE_TIME"];

		return $arParams;
	}

	public function executeComponent() {
		$this->filter = $GLOBALS[ $this->arParams[ "FILTER_NAME" ] ];

		$val =  $this->getCntCached();
		return $val;
	}


	private function getCntCached() {
		$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cacheTtl = $this->arParams["CACHE_TIME"];
		$cacheId = md5( serialize( $this->filter ) );
		$cachePath = self::CACHE_PATH;

		$value = array();


		if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
			$value = $cache->getVars();
			$value["cached"] = 'true';
		}
		elseif ($cache->startDataCache()) {
			$value = $this->getCnt();

			$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
			$cache_manager->startTagCache($cachePath);
			$cache_manager->registerTag("iblock_id_" . $this->arParams["IBLOCK_ID"]);
			$cache_manager->endTagCache();

			$cache->endDataCache($value);
		}

		if ( $this->debug ) $value["key"] = $cacheId;

		return $value;
	}

	private function getCnt() {
		\CModule::IncludeModule('iblock');

		$arFilter = $GLOBALS[ $this->arParams["FILTER_NAME"] ];
		$arFilter[ "IBLOCK_ID" ] = $this->arParams["IBLOCK_ID"];
		$arFilter[ "ACTIVE" ] = "Y";

		$rs = \CIBlockElement::GetList( array(), $arFilter );

		if ( $this->debug ) {
			$ar = array();
			while ($el = $rs->GetNext()) $ar[] = $el["NAME"];

			return array(
				"ar" => $ar,
				"cnt0" => count( $ar ),
				"cnt" => $rs->SelectedRowsCount()
			);
		}
		else {
			return array(
				"cnt" => $rs->SelectedRowsCount()
			);
		}


	}
}