<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CManualSectionList extends CBitrixComponent {
	const CACHE_PATH =  "/" . SITE_ID . "/gipermed/" . __CLASS__  . "/";

	public function onPrepareComponentParams($arParams)	{
		$arParams["IBLOCK_ID"] = (int)$arParams["IBLOCK_ID"];
		$arParams["CACHE_TIME"] = (int)$arParams["CACHE_TIME"];

		return $arParams;
	}

	public function executeComponent() {
		$this->arResult[ "SECTIONS" ] = $this->getSectionsCached();

		$this->IncludeComponentTemplate();
	}


	private function getSectionsCached() {
		$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cacheTtl = $this->arParams["CACHE_TIME"];
		$cacheId = "";
		$cachePath = self::CACHE_PATH;


		if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
			$value = $cache->getVars();
		}
		elseif ($cache->startDataCache()) {
			$value = $this->getSections();

			$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
			$cache_manager->startTagCache($cachePath);
			$cache_manager->registerTag("iblock_id_" . $this->arParams["IBLOCK_ID"]);
			$cache_manager->endTagCache();

			$cache->endDataCache($value);
		}

		return $value;
	}

	private function getSections() {
		$arFilter = array(
			"IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
			"ID" => $this->getSectionIds()
		);

		$rs = \CIBlockSection::GetList( array(), $arFilter );

		$arSections = array();

		while ($row = $rs->GetNext()) {
			$arSections[] = $row;
		}

		return $arSections;
	}

	private function getSectionIds() {
		\CModule::IncludeModule('iblock');

		$arSectionIds = array();

		$arFilter = $GLOBALS[ $this->arParams["FILTER_NAME"] ];
		$arFilter[ "IBLOCK_ID" ] = $this->arParams["IBLOCK_ID"];

		$rs = \CIBlockElement::GetList( array(), $arFilter );

		while ($row = $rs->Fetch()) {
			$arSectionIds[] = $row[ "IBLOCK_SECTION_ID" ];
		}

		return $arSectionIds;
	}
}