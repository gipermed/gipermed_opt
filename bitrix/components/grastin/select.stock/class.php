<?

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Grastin\Delivery\Constant;
use Grastin\Delivery\Entity\SelfPickupTable;
use Grastin\Delivery\Options;
use Grastin\Delivery\Selfpickup\Settings;
use Grastin\Delivery\Selfpickup;
use Grastin\Delivery\Yandex\Geo\Api as YandexApi;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

Loc::loadMessages(__FILE__);

if (!\Bitrix\Main\Loader::includeModule('iblock')) {
	ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
	return;
}

class GrastinSelectStock extends CBitrixComponent {

	protected $sid = null;

	/**
	 * @var $delivery Selfpickup\Core
	 */
	protected $delivery = null;

	protected $useSearchRadius = false;

	protected $locationCoords = null;

	/**
	 * Processing parameters unique to catalog.element component.
	 *
	 * @param array $params Component parameters.
	 * @return array
	 */
	public function onPrepareComponentParams($params) {

		if (strlen($params['DELIVERY']) > 0)
			$params['DELIVERY'] = explode(":", $params['DELIVERY']);

		if (is_array($params['DELIVERY']) && !empty($params['DELIVERY']))
			$this->sid = array_pop($params['DELIVERY']);

		$this->useSearchRadius = ($params["USE_SEARCH_RADIUS"] == "Y" && ($params["LOCATION"] || $params["CITY"]));

		return $params;
	}

	public function executeComponent() {
		try {
			$this->checkModules();

			$this->loadDelivery();

			$this->loadPoints();
		}
		catch (SystemException $ex) {
			$this->arResult['ERROR'] = $ex->getMessage();
		}

		$this->includeComponentTemplate();
	}

	protected function checkModules() {
		return (
			Loader::includeModule('sale')
			&& Loader::includeModule('grastin.delivery')
		);
	}

	protected function loadDelivery() {
		$deliveryMap = Settings::getDeliveryMap();
		if (!isset($deliveryMap[$this->sid]))
			throw new SystemException(Loc::getMessage("SELECT_STOCK_M_NOT_FOUND_ALLOW_DELIVERY_SYSTEM"));

		$this->delivery = $deliveryMap[$this->sid];
	}

	protected function getCoordsByLocation($location, $city = "") {
		if (!$location)
			return null;

		if (CSaleLocation::checkIsCode($location))
			$arLocation = \Bitrix\Sale\Location\LocationTable::getByCode($location)->fetch();
		else
			$arLocation = \Bitrix\Sale\Location\LocationTable::getById($location)->fetch();

		if (!$arLocation)
			return null;

		if (!$city && (float)$arLocation["LATITUDE"] && (float)$arLocation["LONGITUDE"])
			return array($arLocation["LATITUDE"], $arLocation["LONGITUDE"]);

		$address = $this->getAddressByLocation($arLocation["CODE"], $city);
		if (!$address)
			return null;

		try {
			$geoobject = $this->geocode($address);
			if ($geoobject)
				return [$geoobject->getLatitude(), $geoobject->getLongitude()];
		}
		catch (\Grastin\Delivery\Yandex\Geo\Exception $e) {
		}

		return null;
	}

	protected function getAddressByLocation($location, $city = "", $skipCountryDistrict = true, $lang = LANGUAGE_ID) {
		if (!$location)
			return "";

		$addressParts = array();

		$filter = array("=NAME.LANGUAGE_ID" => $lang);
		if ($skipCountryDistrict)
			$filter["!TYPE_CODE"] = "COUNTRY_DISTRICT";

		$rsPath = \Bitrix\Sale\Location\LocationTable::getPathToNodeByCondition(
			array(
				(CSaleLocation::checkIsCode($location)) ? '=CODE' : '=ID' => $location
			),
			array(
				"select" => array("LOCATION_NAME" => "NAME.NAME", "TYPE_CODE" => "TYPE.CODE", "*"),
				"filter" => $filter
			)
		);
		$arLocations = array();
		while ($arLocation = $rsPath->fetch()) {
			$addressParts[] = $arLocation["LOCATION_NAME"];
		}
		if ($city)
			$addressParts[] = $city;
		return implode(", ", array_reverse($addressParts));
	}

	/**
	 * Список доступных ПВЗ
	 */
	protected function loadPoints() {
		$deliverySid = $this->delivery->getSid();

		$this->arResult["API_KEY"] = (string)Options::getYandexKey();

		$filter = array(
			"TYPE" => $this->delivery->getSid()
		);
		$this->locationCoords = null;
		if ($this->useSearchRadius) {
			$this->locationCoords = $this->getCoordsByLocation($this->arParams["LOCATION"], $this->arParams["CITY"]);
		}

		$this->arResult["DISTANCE"] = Options::getOption(Constant::OPTION_PICKUP_SEARCH_RADIUS);

		$cacheKey = array(
			"load_points_" . $deliverySid => array(
				$this->arResult["DISTANCE"],
				$this->locationCoords
			)
		);
		$points = \Grastin\Delivery\Cache::remember($cacheKey, 60, function () {
			$points = array();

			$res = null;
			$params = array(
				'filter' => array(
					"TYPE" => $this->delivery->getSid(),
				),
				'order' => array('ID' => 'ASC'),

			);
			if ($this->locationCoords) {
				$params["filter"]["<=DISTANCE"] = $this->arResult["DISTANCE"];
				$params['order'] = array('DISTANCE' => 'ASC');
				$res = SelfPickupTable::findNearest((float)$this->locationCoords[0], (float)$this->locationCoords[1], $params);
			}
			else {
				$res = SelfPickupTable::getList($params);
			}

			if ($res) {
				while ($arr = $res->fetch()) {
					$points[$arr['ID']] = $arr;
				}
			}
			return $points;
		}, "points");

		if (empty($points)) {
			$message = Loc::getMessage("SELECT_STOCK_M_NOT_FOUND_PICKUP_POINTS");
			if ($this->locationCoords) {
				if (SelfPickupTable::getCount())
					$message = Loc::getMessage("SELECT_STOCK_M_NOT_FOUND_NEAREST_PICKUP_POINTS", array("#DISTANCE#" => $this->arResult["DISTANCE"]));
			}
			throw new SystemException($message);
		}

		$this->arResult['DELIVERY_POINTS'] = $points;
	}

	/**
	 * @param $address
	 * @return mixed
	 * @throws \Grastin\Delivery\Yandex\Geo\Exception
	 * @throws \Grastin\Delivery\Yandex\Geo\Exception\CurlError
	 * @throws \Grastin\Delivery\Yandex\Geo\Exception\ServerError
	 */
	protected function geocode($address) {
		$response = $this->getYandex()->setQuery($address)->load()->getResponse();
		$location = reset($response->getList());

		if ($location instanceof \Grastin\Delivery\Yandex\Geo\GeoObject)
			return $location;

		$data = $response->getData();
		if (isset($data['error']))
			throw new \Grastin\Delivery\Yandex\Geo\Exception($data['error']['message']);
		throw new \Grastin\Delivery\Yandex\Geo\Exception('Geocoding failed');
	}

	protected function getYandex() {
		if (!isset($this->yandex)) {
			$this->yandex = new YandexApi();
			$this->yandex->setLimit(1);

			$langConstant = get_class($this->yandex) . '::' . strtoupper(LANGUAGE_ID);
			$lang = (defined($langConstant)) ? constant($langConstant) : YandexApi::LANG_RU;
			$this->yandex->setLang($lang);
			if ($this->arResult["API_KEY"]) {
				$this->yandex->setToken($this->arResult["API_KEY"]);
			}

			$needCache = Options::needCacheYandexGeocode();
			$cacheTime = Options::getCacheYandexGeocodeTime();
			if ($needCache && $cacheTime > 0) {
				$this->yandex->setCacheTime($cacheTime);
			}
		}
		return $this->yandex;
	}
}