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


<? if ( count($arResult["ITEMS"]) > 0 ): ?>
<div class="main-carousel">
	<?foreach ($arResult["ITEMS"] as $arItem):?>
		<div class="carousel-cell">
			<a href="<?=$arItem[ "PROPERTIES" ][ "URL" ][ "VALUE" ]?>">
				<img src="<?=$arItem[ "BIG_IMG" ]?>" class="md-slide" alt="<?=$arItem["NAME"]?>">
				<img src="<?=$arItem[ "SMALL_IMG" ]?>" alt="<?=$arItem["NAME"]?>" class="xs-slide">
			</a>
		</div>
	<?endforeach?>
</div>
<?endif?>