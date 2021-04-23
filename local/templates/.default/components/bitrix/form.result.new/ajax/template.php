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
		echo $sMessage;
	}
	if ($arResult["isFormNote"] == "Y" || $_REQUEST['formresult']=='addok') {
		$sMessage = $arResult["FORM_NOTE"];
		$bError = false;
		echo "Заявка успешно отправлена";
		die();
	}
}

global $nameGood;
?>
<form action="" class="form" name="<?=$arResult["WEB_FORM_NAME"]?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="WEB_FORM_ID" value="<?=$arResult["arForm"]["ID"]?>" />
	<input type="hidden" name="form_hidden_6" value="<?=$nameGood;?>" />
			<?=bitrix_sessid_post()?>
	<table class="form-table">
		<tr>
			<td>Телефон:</td>
			<td>
				<label class="form-label" aria-label="Телефон">
					<input type="tel" name='form_text_5' class="input" required>
				</label>
			</td>
		</tr>
		<tr>
			<td>Имя:</td>
			<td>
				<label class="form-label" aria-label="Имя">
					<input type="text" name='form_text_3' class="input" required>
				</label>
			</td>
		</tr>
	</table>
	<div class="form-submit-wrapp">
		<button class="submit btn btn-red" type="submit" name="web_form_submit" value='<?=GetMessage("FORM_SEND")?>'><?=GetMessage("FORM_SEND")?></button>
	</div>
	<div class="form-info">Нажимая кнопку «Отправить», я принимаю условия <a href="/politika/">политики конфиденциальности</a> и <a href="#">пользовательского соглашения</a>.</div>
</form>