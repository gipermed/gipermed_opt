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

<div class="manufacturers clearfix js-items-container">
	<!--items-container-->
	<?foreach ($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>

		<div class="manufacturer-block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<div class="img-wrap">
					<img src="<?=$arItem[ "SRC" ]?>" alt="<?=$arItem["NAME"]?>">
				</div>
				<span class="name"><?=$arItem["NAME"]?></span>
			</a>
			<div class="overlay"></div>
		</div>
	<?endforeach?>
	<!--items-container-->
</div>
<div id="js-pagination-container">
	<!--pagination-container-->
	<?=$arResult["NAV_STRING"]?>
	<!--pagination-container-->
</div>