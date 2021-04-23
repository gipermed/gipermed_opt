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
<div class="info__col">
  <p class="info__title title">Новости</p>
  <div class="info__content">
    <section class="info__news">
	<?foreach ($arResult["ITEMS"] as $arItem):?>
		<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="info__item">
			<a class="info__date" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=FormatDate("j F Y", MakeTimeStamp($arItem["ACTIVE_FROM"]))?></a>
			<a class="info__name" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
		</div>
 	<?endforeach?>
    </section><a class="link_full" href="/news/">Все новости<span>
        <svg class="icon icon-arrow">
          <use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#arrow"></use>
        </svg></span></a>
  </div>
</div>

