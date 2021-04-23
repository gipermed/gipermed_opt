<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");?>
<div style="text-align: center">
	<img src="<?=DEFAULT_TEMPLATE_PATH?>img/404.png" alt="">
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>