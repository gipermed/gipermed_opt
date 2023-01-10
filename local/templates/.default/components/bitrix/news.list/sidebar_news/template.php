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


<div class="sidebar-news">
	<div class="title">
		<span>Новости</span>
		<img src="/local/templates/.default/img/sn-img-72x34.png" alt="">
	</div>


	<?foreach ($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<span class="date">
				<?=FormatDate("j F Y", MakeTimeStamp($arItem["ACTIVE_FROM"]))?>
			</span>
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<?=$arItem["NAME"]?>
			</a>
		</div>
	<?endforeach?>

	<div class="more">
		<a href="/news/" class="all-news">Все новости<i class="all-news-icon"></i></a>
	</div>
</div>

