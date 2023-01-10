<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CGetItemIds extends CBitrixComponent {
	const CACHE_PATH =  "/" . SITE_ID . "/gipermed/" . __CLASS__  . "/";

	public function onPrepareComponentParams($arParams)	{
		$arParams[ "CACHE_TIME" ] = (int)$arParams[ "CACHE_TIME" ];

		return $arParams;
	}

	public function executeComponent() {
		return $this->getResultCached();
	}


	private function getResultCached() {
		$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cacheTtl = $this->arParams["CACHE_TIME"];
		$cachePath = self::CACHE_PATH;
		$cacheId = md5(
			$this->arParams[ "ID" ]
			. "_"
			. json_encode( $this->arParams[ "FILTER" ] )
		);

		$value = array();


		if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
			$value = $cache->getVars();
		}
		elseif ($cache->startDataCache()) {
			$value = $this->getResult();

			$iblockId = $this->arParams[ "FILTER" ][ "IBLOCK_ID" ];
			if ( $iblockId ) {
				$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
				$cache_manager->startTagCache($cachePath);
				$cache_manager->registerTag("iblock_id_" . $iblockId);
				$cache_manager->endTagCache();
			}

			$cache->endDataCache($value);
		}

		return $value;
	}

	private function getResult() {
		\CModule::IncludeModule('iblock');

		$rs = \CIBlockElement::GetList(
			array(),
			$this->arParams[ "FILTER" ],
			false,
			false,
			array( "ID" )
		);

		$ar = array();
		while ($el = $rs->GetNext())
			$ar[] = $el[ "ID" ];

		return $ar;
	}
}