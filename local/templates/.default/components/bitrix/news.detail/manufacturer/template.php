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



	<div class="img-wrap">
		<?
		$img =
			$arResult["FIELDS"]["DETAIL_PICTURE"]["SRC"] ?:
			$arResult["FIELDS"]["PREVIEW_PICTURE"]["SRC"]
		?>
		<img src="<?=$img?>" alt="<?=$arResult["NAME"]?>" class="left-img">
	</div>
	<?=$arResult["DETAIL_TEXT"]?>

