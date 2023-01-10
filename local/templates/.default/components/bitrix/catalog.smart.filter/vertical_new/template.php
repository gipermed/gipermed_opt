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
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input
				type="hidden"
				name="<?echo $arItem["CONTROL_NAME"]?>"
				id="<?echo $arItem["CONTROL_ID"]?>"
				value="<?echo $arItem["HTML_VALUE"]?>"
				/>
		<?endforeach?>


		<? //prices retail only ?>
		
		<?// foreach($arResult["ITEMS"] as $key=>$arItem): ?>
			<? //if ( !isset( $arItem["PRICE"] ) )  continue; ?>
			<? //if ( $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0 )	continue; ?>
			<? //$key = $arItem["ENCODED_ID"]; ?>
 			<!--
			<div class="category-filter-section">
				<div class="content-title"><?=$arItem["NAME"]?>, ₽</div>
				<div class="range-slider-wrapp">
					<ul class="range-inputs">
						<li>
							<label class="form-block">
								<span class="range-input-title">От</span>
								<input
									class="min-price input input-small range-input range-input-from"
									type="text"
									name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
									id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
									value="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
									onkeyup="smartFilter.keyup(this)"
									oninput="console.log(this)"
									placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
									/>
							</label>
						</li>
						<li>
							<label class="form-block">
								<span class="range-input-title">до</span>
								<input
								class="max-price input input-small range-input range-input-to"
								type="text"
								name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
								id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
								value="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"
								onkeyup="smartFilter.keyup(this)"
								oninput="smartFilter.keyup(this)"
								placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
								/>
							</label>
						</li>
					</ul>
					<div class="range-slider" data-min="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" data-max="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" data-value-from="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>" data-value-to="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" data-step="10">
						<div class="range-slider-info range-slider-from"><?=$arItem["VALUES"]["MIN"]["VALUE"]?></div>
						<div class="range-slider-info range-slider-center"><?=round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) /2 )?></div>
						<div class="range-slider-info range-slider-to"><?=$arItem["VALUES"]["MAX"]["VALUE"]?></div>
					</div>
				</div>
			</div>
			-->
		<?//endforeach ?>

		<?php // wholesale price  ?>
		<? foreach($arResult["ITEMS"] as $key=>$arItem): ?>
			<?php if($arItem["CODE"] == "PRICE_WHOLESALE"): ?>

					<? if ( $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0 )	continue; ?>
					<? $key = $arItem["ENCODED_ID"]; ?>
					<?php
					 $minValue = isset($arItem['VALUES']['MIN']['HTML_VALUE']) ? $arItem['VALUES']['MIN']['HTML_VALUE'] : $arItem["VALUES"]["MIN"]["VALUE"];
					 $maxValue = isset($arItem['VALUES']['MAX']['HTML_VALUE']) ? $arItem['VALUES']['MAX']['HTML_VALUE'] : $arItem["VALUES"]["MAX"]["VALUE"];
					 $minValue = round($minValue, 2);
					 $maxValue = round($maxValue, 2);
					 ?>

					<div class="category-filter-section">
						<div class="content-title"><?=$arItem["NAME"]?>, ₽</div>
						<div class="range-slider-wrapp">
							<ul class="range-inputs">
								<li>
									<label class="form-block">
										<span class="range-input-title">От</span>
										<input
											class="min-price input input-small range-input range-input-from"
											type="text"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?= $minValue ?>"
											onkeyup="smartFilter.keyup(this)"
											oninput="console.log(this)"
											placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
											/>
									</label>
								</li>
								<li>
									<label class="form-block">
										<span class="range-input-title">до</span>
										<input
										class="max-price input input-small range-input range-input-to"
										type="text"
										name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
										value="<?= $maxValue?>"
										onkeyup="smartFilter.keyup(this)"
										oninput="smartFilter.keyup(this)"
										placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
										/>
									</label>
								</li>
							</ul>
							<?php $steps =round(($maxValue - $minValue) / 100);?>
							<div class="range-slider" data-min="<?= $arItem["VALUES"]["MIN"]["VALUE"]?>" data-max="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" data-value-from="<?= $arItem["VALUES"]["MIN"]["VALUE"]?>" data-value-to="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>" data-step="<?= $steps ?>">
								<div class="range-slider-info range-slider-from"><?= round($arItem["VALUES"]["MIN"]["VALUE"], 2)?></div>
								<div class="range-slider-info range-slider-center"><?=round(($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) /2 )?></div>
								<div class="range-slider-info range-slider-to"><?= round($arItem["VALUES"]["MAX"]["VALUE"], 2)?></div>
							</div>
						</div>
					</div>

			<?php endif; ?>
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
			<div class="category-filter-section">
				<div class="content-title"><?=$arItem["NAME"]?></div>
				<ul class="category-filter-list">
					<?foreach(array_slice($arItem["VALUES"], 0, 10) as $val => $ar):?>
					<li><label data-role="label_<?=$ar["CONTROL_ID"]?>" class="checkbox-label <?=$ar["CHECKED"]? 'active': '' ?> <?=$ar["DISABLED"] ? 'hidden': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
						<input type="checkbox" class="checkbox-input" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"]? 'checked="checked"': '' ?> onclick="smartFilter.click(this)" />
						<span><?=$ar["VALUE"];?></span>
					</label></li>
					<?endforeach;?>
				</ul>
				<?if(count($arItem["VALUES"]) >= 10):?>
				<ul class="category-filter-list category-filter-list-more">
					<?foreach(array_slice($arItem["VALUES"], 10) as $val => $ar):?>
					<li><label data-role="label_<?=$ar["CONTROL_ID"]?>" class="checkbox-label <?=$ar["CHECKED"]? 'active': '' ?> <?=$ar["DISABLED"] ? 'hidden': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
						<input type="checkbox" class="checkbox-input" value="<? echo $ar["HTML_VALUE"] ?>" name="<? echo $ar["CONTROL_NAME"] ?>" id="<? echo $ar["CONTROL_ID"] ?>" <? echo $ar["CHECKED"]? 'checked="checked"': '' ?> onclick="smartFilter.click(this)" />
						<span><?=$ar["VALUE"];?></span>
					</label></li>
					<?endforeach;?>
				</ul>
				<a href="#" class="category-filter-list-toggle" data-text="Показать все" data-text-active="Свернуть">Показать все</a>
				<?endif;?>
			</div>
		<? endforeach ?>
		<div class="filter-btns category-filter-section">
			<ul class="category-filter-btns">
				<li><button type="submit" id="set_filter" class="apply category-filter-submit btn btn-red" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"><?=GetMessage("CT_BCSF_SET_FILTER")?></button></li>
				<li><a onClick="$(this).closest('form').submit();" href="javascript:void(0);" id="del_filter" class="clear category-filter-reset" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"><?=GetMessage("CT_BCSF_DEL_FILTER")?></a></li>
			</ul>
		</div>

		<div class="bx_filter_popup_result" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
			<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
			<span class="arrow"></span>
			<a href="<?echo $arResult["FILTER_URL"]?>"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
		</div>
	</form>

<script>
    var smartFilter = new JCSmartFilter(
        '<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>',
        '<?= CUtil::JSEscape($arResult['SEF_DEL_FILTER_URL']) ?>',
        'vertical_new'
    );
</script>