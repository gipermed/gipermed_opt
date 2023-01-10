<?php
/**
 * Created by PhpStorm.
 * User: orange
 * Date: 22.11.2017
 * Time: 2:52
 */

namespace BxAid;


class IdMaster {
	private static $cacheTime = 36000000;
	private static $cacheDir = "/BxAid/IdMaster/";
	private static $debug = false;

	public static function getIblockId($code, $forceRewriting = false) {
		$cache = \Bitrix\Main\Data\Cache::createInstance();

		if (self::$debug) echo "$code<br>";
		if (self::$debug) echo $forceRewriting ? "y" : "n" . "<br>";

		if ($forceRewriting) $cache->forceRewriting(true);

		$cacheId = "iblock";
		if ($cache->initCache(self::$cacheTime, $cacheId, self::$cacheDir)) {
			$result = $cache->getVars();

			if (self::$debug) echo "from cache<br>";
		}
		elseif ($cache->startDataCache()) {
			$result = self::selectIblockIdList();
			if (self::$debug) echo "from DB<br>";
			$cache->endDataCache($result);
		}

		if (self::$debug) echo "<pre>", print_r($result), "</pre>";

		if ($result[$code]) {
			return $result[$code];
		}
		elseif (!$forceRewriting) {
			self::getIblockId($code, true);
		}
		else {
			throw new \Exception("$cacheId $code not found");
		}

	}

	private static function selectIblockIdList() {
		\CModule::IncludeModule('iblock');

		$arIdByCode = array();

		$rs = \CIBlock::GetList();

		while ($el = $rs->Fetch())
			$arIdByCode[ $el["CODE"] ] = $el["ID"];

		return $arIdByCode;
	}
}