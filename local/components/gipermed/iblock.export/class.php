<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CIblockExport extends CBitrixComponent {
	const CACHE_PATH =  "/" . SITE_ID . "/gipermed/" . __CLASS__  . "/";

	public function onPrepareComponentParams($arParams)	{
		$arParams[ "ID" ] = (int)$arParams[ "ID" ];
		$arParams[ "IBLOCK_ID" ] = (int)$arParams[ "IBLOCK_ID" ];
		$arParams[ "CACHE_TIME" ] = (int)$arParams[ "CACHE_TIME" ];
		$arParams[ "UPDATED_ONLY" ] = $arParams[ "UPDATED_ONLY" ] == "Y";


		return $arParams;
	}

	public function executeComponent() {
		$id = $this->arParams[ "ID" ];

		$res = $id
			? $this->getResult( $id )
			: $this->getResultCached()
		;

		echo serialize( $res );
	}


	private function getResultCached() {
		$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cacheTtl = $this->arParams["CACHE_TIME"];
		$cacheId = md5( $this->arParams[ "IBLOCK_ID" ] );
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

	private function getResult( $id = 0 ) {
		$arSelect = array(
			"ID",
			"NAME",
			"CODE",
			"ACTIVE",
			"DATE_ACTIVE_FROM",
			"PREVIEW_TEXT",
			"PROPERTY_MORE_PHOTO",
		);



		$arFilter = array(
			"IBLOCK_ID" => $this->arParams[ "IBLOCK_ID" ],
		);

		if ( $id ) $arFilter[ "ID" ] = $id;

		if ( $this->arParams["UPDATED_ONLY"] )
			$arFilter[ ">TIMESTAMP_X" ] = ConvertTimeStamp(time()-86400);



		\CModule::IncludeModule('iblock');
		$rs = \CIBlockElement::GetList(	array(), $arFilter, false, false, $arSelect );


		$ar = array();

		while ( $el = $rs->Fetch() ) {
			$id = $el["ID"];

			$ar[ $id ][ "ACTIVE" ] = $el[ "ACTIVE" ];

			if ( $el[ "ACTIVE" ] == "Y" ) {
				$ar[ $id ][ "NAME" ] = $el[ "NAME" ];
				$ar[ $id ][ "CODE" ] = $el[ "CODE" ];
				$ar[ $id ][ "PREVIEW_TEXT" ] = $el[ "PREVIEW_TEXT" ];
				$ar[ $id ][ "DATE_ACTIVE_FROM" ] = $el[ "DATE_ACTIVE_FROM" ];
				$ar[ $id ][ "PHOTO" ][] = \CFile::GetPath( $el[ "PROPERTY_MORE_PHOTO_VALUE" ] );
				$ar[ $id ][ "HASH" ] = md5( serialize( $ar[ $id ] ) );
			}
		}

		return $ar;
	}
}