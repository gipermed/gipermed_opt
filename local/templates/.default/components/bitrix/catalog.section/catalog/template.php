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

	<div class="catalog-box clearfix" style="width:100%">
		<? foreach ($arResult["ITEMS"] as $arItem): ?>
			<?
			$uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
			$itemId = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);
			?>
			<div class="product-card" id="<?= $itemId ?>">
				<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "", $arItem ) ?>
				<div class="overlay"></div>
			</div>
		<? endforeach ?>
	</div>
<div class="pagen-wrap">
<?= $arResult["NAV_STRING"] ?>
</div>

<? $this->SetViewTarget('SECTION_NAV_STRING'); ?>
<?= $arResult["NAV_STRING"] ?>
<? $this->EndViewTarget(); ?>


<? if ($arResult["DESCRIPTION"]): ?>
	<div class="category-desc">
		<?= $arResult["DESCRIPTION"] ?>
	</div>
<? endif ?>