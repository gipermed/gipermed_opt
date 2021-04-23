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
<div class="modal" data-modals="call">
    <div class="modal--close"></div>
    <div class="modal__body">
      <div class="modal__top">
        <div class="modal__title title">Заказать звонок
          <div class="modal__closes">
            <svg class="icon icon-cross">
              <use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#cross"></use>
            </svg>
          </div>
        </div>
      </div>
      <div class="modal__content">
      	<span class="desc"></span>
        <form class="modal__form form js-ajax-form" name="<?=$arResult["WEB_FORM_NAME"]?>" method="post" enctype="multipart/form-data">
    		<input type="hidden" name="WEB_FORM_ID" value="<?=$arResult["arForm"]["ID"]?>" />
			<?=bitrix_sessid_post()?>
			<table>
				<?
				foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
				<?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'):?>
					<?=$arQuestion["HTML_CODE"]?>
				<?else:?>
				<tr>
					<td class="modal__name"><?= $arQuestion['CAPTION'] ?>:</td>
			      	<td>
			            <?=$arQuestion["HTML_CODE"]?>
			        </td>
			    </tr>
				<?endif?>
			<?endforeach?>            
			<div class="modal__name"></div>
			</table>
          <div class="modal__col">
          	<?if($arResult["isUseCaptcha"] == "Y"):?>
					<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
					<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
				<?endif?>
          	<input type="submit" name="web_form_submit" class="modal__send" value="<?=GetMessage("FORM_SEND")?>" />
          </div>
        </form>
        <div class="modal__text">Нажимая кнопку «Отправить», я принимаю условия<a href="#">политики конфиденциальности</a> и<a href="#"> пользовательского соглашения.</a></div>
      </div>
    </div>
  </div>