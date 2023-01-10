<?
/** @global CMain $APPLICATION */
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

/**
 * TODO заготовка для ajax методов
 */
try {
	$APPLICATION->RestartBuffer();
	header('Content-Type: application/json');
	echo Main\Web\Json::encode(array("STATUS" => "SUCCESS"));
}
catch(SystemException $ex) {
	$APPLICATION->RestartBuffer();
	header('Content-Type: application/json');
	echo Main\Web\Json::encode(array("STATUS" => "ERROR", "TEXT" => "UNDEFINED COMMAND"));
}
