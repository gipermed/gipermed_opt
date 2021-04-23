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
$item = $arResult["ITEMS"][0];
?>
<?if ($item):?>
	<?if ($item["PREVIEW_TEXT"]):?>
		<?=$item["~PREVIEW_TEXT"]?>
	<?else:?>
		<?if ($item["PROPERTIES"]["URL"]["VALUE"]):?>
			<a href="<?=$item["PROPERTIES"]["URL"]["VALUE"]?>">
				<img src="<?=$item["IMG"]?>" alt="">
			</a>
		<?else:?>
			<img src="<?=$item["IMG"]?>" alt="">
		<?endif?>
	<?endif?>
<?endif?>

