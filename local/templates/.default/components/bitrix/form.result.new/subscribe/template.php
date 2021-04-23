<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(false);
$formId = $arResult["arForm"]["ID"];
global $APPLICATION;

if (!function_exists("getFieldName")) {
	function getFieldName($sid, $arResult) {
		$formId = $arResult["arForm"]["ID"];
		$name = GetMessage("FORM_DEF_{$formId}_FIELD_{$sid}");

		if (empty($name)) {
			$name = GetMessage("FORM_DEF_FIELD_{$sid}");
		}

		if (empty($name)) {
			$name = $arResult["QUESTIONS"][$sid]["CAPTION"];
		}

		return $name;
	}
}


?>

<?if ($arResult["isFormErrors"] == "Y" || $arResult["isFormNote"] == "Y") {
	\Bitrix\Main\Data\StaticHtmlCache::getInstance()->markNonCacheable();
	$APPLICATION->RestartBuffer();
	if ($arResult["isFormErrors"] == "Y") {
		$sMessage = $arResult["FORM_ERRORS_TEXT"];
		$bError = true;
		echo json_encode(array('text' => $sMessage, 'error' => $bError));
	}
	if ($arResult["isFormNote"] == "Y" || $_REQUEST['formresult']=='addok') {
		$sMessage = $arResult["FORM_NOTE"];
		$bError = false;
		echo json_encode(array('text' => $sMessage, 'error' => $bError));
	}
	die();
}
?>
<article class="subscribe">
    <div class="container">
      <div class="subscribe__row flex-row">
        <p class="title">Выгодные предложения для подписчиков</p>
        <span class="desc"></span>
        <form class="modal__form form flex-row subscribe__form js-ajax-form" name="<?=$arResult["WEB_FORM_NAME"]?>" method="post" enctype="multipart/form-data">
        	<input type="hidden" name="WEB_FORM_ID" value="<?=$arResult["arForm"]["ID"]?>" />
        	<?=bitrix_sessid_post()?>
        	<?
				foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
					<?=$arQuestion["HTML_CODE"]?>
			<?endforeach?>    
          	<input class="subscribe__btn" type="submit" name="web_form_submit" value="Подписаться">
        </form>
      </div>
    </div>
</article>