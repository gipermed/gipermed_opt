<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div>
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input
				type="hidden"
				name="<?echo $arItem["CONTROL_NAME"]?>"
				id="<?echo $arItem["CONTROL_ID"]?>"
				value="<?echo $arItem["HTML_VALUE"]?>"
				/>
		<?endforeach?>

		<? //prices ?>
		<? foreach($arResult["ITEMS"] as $key=>$arItem): ?>
			<? if ( !isset( $arItem["PRICE"] ) )  continue; ?>
			<? if ( $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0 )	continue; ?>
			<? $key = $arItem["ENCODED_ID"]; ?>

			<div class="filter-box">
				<span class="heading"><?=$arItem["NAME"]?></span>
				<div class="filter-box__container_modef"></div>
				<div class="input-group clearfix">
					<input
						class="min-price"
						type="text"
						name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
						id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
						value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
						onkeyup="smartFilter.keyup(this)"
						placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
						/>
					<span>&nbsp;&#8212;&nbsp;</span>
					<input
						class="max-price"
						type="text"
						name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
						id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
						value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
						onkeyup="smartFilter.keyup(this)"
						placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
						/>
				</div>
			</div>
		<?endforeach ?>

		<? //not prices ?>
		<? foreach($arResult["ITEMS"] as $key=>$arItem): ?>
			<? if ( empty($arItem["VALUES"] ) ) continue; ?>
			<? if ( isset($arItem["PRICE"] ) ) continue ?>

			<? $arNotAvailableTypes = array(
				"A", //NUMBERS_WITH_SLIDER
				"B", //NUMBERS
				"G", //CHECKBOXES_WITH_PICTURES
				"H", //CHECKBOXES_WITH_PICTURES_AND_LABELS
				"P", //DROPDOWN
				"R", //DROPDOWN_WITH_PICTURES_AND_LABELS
				"K", //RADIO_BUTTONS
				"U" //CALENDAR
			) ?>

			<? if ( in_array($arItem["DISPLAY_TYPE"], $arNotAvailableTypes ) ) continue ?>

			<?
			if (
				$arItem["DISPLAY_TYPE"] == "A"
				&& (
					$arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
				)
			)
				continue;
			?>

			<div class="filter-box">
				<span class="heading"><?=$arItem["NAME"]?></span>
				<div class="filter-box__container_modef"></div>
				<?foreach($arItem["VALUES"] as $val => $ar):?>
					<div class="checkbox">
						<input
							type="checkbox"
							value="<? echo $ar["HTML_VALUE"] ?>"
							name="<? echo $ar["CONTROL_NAME"] ?>"
							id="<? echo $ar["CONTROL_ID"] ?>"
							<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
							onclick="smartFilter.click(this)"
							/>
						<label
							data-role="label_<?=$ar["CONTROL_ID"]?>"
							class="<? echo $ar["DISABLED"] ? 'hidden': '' ?>"
							for="<? echo $ar["CONTROL_ID"] ?>"
							>
							<span><?=$ar["VALUE"];?></span>
						</label>
					</div>

				<?endforeach;?>
			</div>
		<? endforeach ?>

		<div class="filter-btns">
			<input class="apply" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
			<input class="clear" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />
		</div>

		<div class="bx_filter_popup_result" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
			<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
			<span class="arrow"></span>
			<a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
		</div>
	</form>
</div>




<script>
    var smartFilter = new JCSmartFilter(
        '<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>',
        '<?= CUtil::JSEscape($arResult['SEF_DEL_FILTER_URL']) ?>',
        'vertical'
    );
</script>