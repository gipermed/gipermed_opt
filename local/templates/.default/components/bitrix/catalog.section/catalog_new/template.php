<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<div class="products">
	<div class="products-row flex-row">
		<?foreach ($arResult["ITEMS"] as $arItem): ?>
			<?
			$uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
			$itemId = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
			?>
			<div class="products-col flex-row-item swiper-slide">
				<div class="product-item" id="<?= $itemId ?>">
					<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "new", $arItem ) ?>
				</div>
			</div>
		<?endforeach ?>
	</div>
</div>
<div class="pagen-wrap">
<?= $arResult["NAV_STRING"] ?>
</div>

<? $this->SetViewTarget('SECTION_NAV_STRING'); ?>
<?= $arResult["NAV_STRING"] ?>
<? $this->EndViewTarget(); ?>
</div>
</div>
<?	if ($arResult["DESCRIPTION"]) :?>
	<div class="page-text-section">
		<? if ($arResult["DESCRIPTION"]): ?>
			<?= $arResult["DESCRIPTION"] ?>
		<? endif ?>
	</div>
<? endif; ?>