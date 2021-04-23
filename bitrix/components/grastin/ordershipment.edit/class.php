<?

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Sale\BusinessValue;
use Bitrix\Sale\Delivery\Services\Manager;
use Grastin\Delivery\Admin\OrderEdit;
use Grastin\Delivery\Admin\Profile;
use Grastin\Delivery\Constant;
use Grastin\Delivery\Entity\SelfPickupTable;
use Grastin\Delivery\Handler;
use Grastin\Delivery\Options;
use Grastin\Delivery\Order\Settings as OrderSettings;
use Grastin\Delivery\Selfpickup\Settings as SelfpickupSettings;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

Loc::loadMessages(__FILE__);

/**
 * Компонент для вывода блока выбора ПВЗ при редактировании отгрузки / создании заказа в административной части сайта
 *
 * Class GrastinOrderShipmentEditComponent
 */
class GrastinOrderShipmentEditComponent extends CBitrixComponent {

	/**
	 * @var \Bitrix\Sale\Order
	 */
	private $order;

	public function onPrepareComponentParams($params) {
		$params["ORDER_ID"] = (int)$params["ORDER_ID"];
		$params["SHIPMENT_ID"] = (int)$params["SHIPMENT_ID"];
		return $params;
	}

	public function executeComponent() {
		try {
			$this->checkModules();
			$this->checkMode();
			$this->loadOrder();
			$this->loadLocation();
			$this->loadSelfPickup();
			$this->loadGrastinProfiles();

			$this->arResult["ADDRESS_MODAL_URL"] = Constant::ADDRESS_MODAL_POPUP_URL;
		}
		catch (SystemException $ex) {
			$this->arResult["ERROR"] = $ex->getMessage();
		}

		$this->includeComponentTemplate();
	}

	protected function loadOrder($orderId = "") {
		if (!$orderId)
			$orderId = $this->arParams["ORDER_ID"];

		if (!$orderId)
			return;

		$this->order = \Bitrix\Sale\Order::load($this->arParams["ORDER_ID"]);
		$this->arResult["ORDER"] = $this->order->getFieldValues();
		$personTypeId = $this->order->getPersonTypeId();
		$entityPersonTypeId = Options::get(GRASTIN_DELIVERY_MODULE, Constant::OPTION_PERSONAL_TYPE_E, false, NULL);
		$this->arResult["ORDER"]["PROP_DOMAIN"] = ($personTypeId == $entityPersonTypeId) ? BusinessValue::ENTITY_DOMAIN : BusinessValue::INDIVIDUAL_DOMAIN;
		$properties = $this->order->getPropertyCollection();
		$arProps = $properties->getArray();

		$this->arResult["ORDER"]["PROPERTIES"] = $arProps;
	}

	protected function loadLocation() {
		$this->arResult["LOCATION"] = $this->getPropValue("location");
		$cityPropId = $this->getCityPropId();
		$this->arResult["CITY"] = $cityPropId ? $this->getPropValue($cityPropId) : "";

		if ($this->arResult["MODE"] == OrderEdit::ORDER_CREATE_MODE) {
			$codes = array("address", "selfpickup", "location");
			$props = array();

			foreach ($codes as $code) {
				$individualPropId = Profile::getConsumerProviderValue($code, BusinessValue::INDIVIDUAL_DOMAIN);
				$entityPropId = Profile::getConsumerProviderValue($code, BusinessValue::ENTITY_DOMAIN);
				if ($individualPropId)
					$props["INDIVIDUAL_" . strtoupper($code)] = $individualPropId;
				if ($entityPropId)
					$props["ENTITY_" . strtoupper($code)] = $entityPropId;

				if ($code == "location") {
					if ($props["INDIVIDUAL_LOCATION"]) {
						$arProp = Handler::getOrderProp($props["INDIVIDUAL_LOCATION"]);
						if ($arProp && intval($arProp["INPUT_FIELD_LOCATION"]) > 0)
							$props["INDIVIDUAL_CITY"] = $arProp["INPUT_FIELD_LOCATION"];
					}

					if ($props["ENTITY_LOCATION"]) {
						$arProp = Handler::getOrderProp($props["ENTITY_LOCATION"]);
						if ($arProp && intval($arProp["INPUT_FIELD_LOCATION"]) > 0)
							$props["ENTITY_CITY"] = $arProp["INPUT_FIELD_LOCATION"];
					}
				}
			}

			$this->arResult["PROPERTIES_SETTINGS"] = $props;
		}
	}

	protected function getCityPropId() {
		$cityProp = 0;
		if (!$this->order)
			return $cityProp;

		$locationPropId = $this->getPropId("location");
		$properties = $this->order->getPropertyCollection();
		/** @var \Bitrix\Sale\PropertyValue $property */
		foreach ($properties as $property) {
			if ((int)$property->getPropertyId() != $locationPropId)
				continue;

			$arProperty = $property->getProperty();
			if (!$arProperty || !(int)$arProperty["INPUT_FIELD_LOCATION"])
				continue;

			$cityProp = (int)$arProperty["INPUT_FIELD_LOCATION"];
		}

		return $cityProp;
	}

	protected function loadSelfPickup() {
		$selfpickup = $this->getPropValue("selfpickup");
		if (!$selfpickup)
			return;

		$arSelfPickup = SelfPickupTable::getList(array("filter" => array("XML_ID" => $selfpickup)))->fetch();
		$this->arResult["SELFPICKUP"] = $arSelfPickup;
	}

	protected function getPropValue($propId) {
		if (!$this->order)
			return null;

		if (!is_numeric($propId)) {
			$propId = $this->getPropId($propId);
			if (!$propId)
				return null;
		}

		$properties = $this->order->getPropertyCollection();
		/** @var \Bitrix\Sale\PropertyValue $property */
		foreach ($properties as $property) {
			if ((int)$property->getPropertyId() == $propId)
				return $property->getValue();
		}
		return null;
	}

	protected function getPropId($code) {
		if (!$this->order)
			return 0;
		return (int)Profile::getConsumerProviderValue($code, $this->arResult["ORDER"]["PROP_DOMAIN"]);
	}

	protected function loadGrastinProfiles() {
		$profiles = array();
		$serviceList = Manager::getActiveList();
		$arSelfPickupProfileMap = SelfpickupSettings::getDeliveryMap();

		foreach($serviceList as $id => $service) {
			$profileCode = str_replace(OrderSettings::GRASTIN_DELIVERY_CODE . ":", "", $service["CODE"]);
			if (!array_key_exists($profileCode, $arSelfPickupProfileMap))
				continue;

			$serviceId = (int)$service["ID"];
			$type = $arSelfPickupProfileMap[$profileCode]->getSid();

			$arSelfPickup = SelfPickupTable::getList(array("filter" => array("TYPE" => $type), "limit" => 1))->fetch();
			if ($arSelfPickup)
				$this->arResult["SELFPICKUPS"][$serviceId] = $arSelfPickup;

			$profiles[$serviceId] = $service["CODE"];
		}
		$this->arResult["GRASTIN_PROFILES"] = $profiles;
	}

	protected function checkMode() {
		$this->arResult["MODE"] = ($this->arParams["MODE"]
			&& in_array($this->arParams["MODE"], array(OrderEdit::SHIPMENT_EDIT_MODE, OrderEdit::ORDER_CREATE_MODE))
		) ? $this->arParams["MODE"] : false;

		if (!$this->arResult["MODE"])
			throw new SystemException(Loc::getMessage("GD_ORDER_SHIPMENT_EDIT_NOT_AVAILABLE_MODE"));
	}

	protected function checkModules() {
		return (
			Loader::includeModule("sale")
			&& Loader::includeModule("grastin.delivery")
		);
	}
}