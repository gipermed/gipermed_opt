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

<div class="category">
	<?foreach ( $arResult[ "SECTIONS" ] as $arSection ):?>
	<?if ($arSection["ELEMENT_CNT"] <= 0) continue?>
	<a href="<?=getCatalogSectionUrl($arSection["ID"]);?>">
		<?=$arSection[ "NAME" ]?>
	</a>
	<?endforeach?>
</div>



