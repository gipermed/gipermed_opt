<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


class CAlphabetFilter extends CBitrixComponent {
	const CACHE_PATH =  "/" . SITE_ID . "/gipermed/" . __CLASS__  . "/";

	public function onPrepareComponentParams($arParams)	{
		$arParams["IBLOCK_ID"] = (int)$arParams["IBLOCK_ID"];
		$arParams["CACHE_TIME"] = (int)$arParams["CACHE_TIME"];

		return $arParams;
	}

	public function executeComponent() {
		$this->arResult = $this->getAlphabet();
		$this->arResult[ "VALID" ] = $this->getLetters();


		$req = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
		if ( $letter = $req->get("letter") ) {
			$this->arResult[ "SELECTED" ] = $letter;

			$GLOBALS[ $this->arParams[ "FILTER_NAME" ] ][ "NAME" ] = "$letter%";
		}


		$this->IncludeComponentTemplate();
	}

	private function getAlphabet() {
		$ru = array();
		foreach ( range( 192, 223 ) as $i ) {
			$char = iconv( 'CP1251', 'UTF-8', chr($i) );
			$ru[] = $char;

			if ( $i == 197 ) {
				$char = iconv( 'CP1251', 'UTF-8', chr( 168 ) );
				$ru[] = $char;
			}
		}



		$en = array();
		foreach ( range( 65, 90 ) as $i ) {
			$en[] = chr($i);
		}



		return array(
			"RU" => $ru,
			"EN" => $en
		);
	}

	private function getLetters() {
		$cache = \Bitrix\Main\Data\Cache::createInstance();

		$cacheTtl = $this->arParams["CACHE_TIME"];
		$cacheId = "";
		$cachePath = self::CACHE_PATH;


		if ($cache->initCache($cacheTtl, $cacheId, $cachePath)) {
			$value = $cache->getVars();
		}
		elseif ($cache->startDataCache()) {
			\CModule::IncludeModule('iblock');

			$iblockId =  $this->arParams["IBLOCK_ID"];

			$value = array();

			$rs = \CIBlockElement::GetList(
				array(),
				array( "IBLOCK_ID" => $iblockId ),
				false,
				false,
				array( "ID", "NAME" )
			);

			while ($row = $rs->Fetch()) {
				$letter = substr( $row["NAME"], 0, 1 );
				$letter = strtoupper( $letter );
				$value[ $letter ] = $letter;
			}


			$cache_manager = \Bitrix\Main\Application::getInstance()->getTaggedCache();
			$cache_manager->startTagCache($cachePath);
			$cache_manager->registerTag("iblock_id_" . $this->arParams["IBLOCK_ID"]);
			$cache_manager->endTagCache();

			$cache->endDataCache($value);
		}

		return $value;
	}
}