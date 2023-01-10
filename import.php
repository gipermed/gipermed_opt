<?

$_SERVER["DOCUMENT_ROOT"] = "/home/g/gipermum/opt.newgipermed.ru/public_html";
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];

define(«NO_KEEP_STATISTIC», true);
define(«NOT_CHECK_PERMISSIONS», true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
set_time_limit(0);
//echo"php";

$APPLICATION->IncludeComponent(
	"gipermed:iblock.import",
	"",
	array(
		"IBLOCK_ID" => 4,
		"CACHE_TIME" => 86400,
		"URL" => "https://gipermed.info",
		"FULL_UPDATE" => "N"
	)
);
//echo"php";

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
