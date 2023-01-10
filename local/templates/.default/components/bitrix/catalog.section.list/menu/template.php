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
	<div class="header-catalog">
		<div class="catalog-button">
			<div class="burger">
				<span></span>
			</div>
			<a href="/catalog/"><?=GetMessage("CAT_MENU_TITLE_1")?></a>
		</div>
		<div class="m-catalog-button">
			<span><?=GetMessage("CAT_MENU_TITLE_2")?></span>
		</div>
		<? include "mobile.php"; ?>
		<? include "desktop.php"; ?>
	</div>

