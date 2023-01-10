<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<div class="footer-menu-col">
	<span class="title"><?=GetMessage("MENU_FOOTER_TITLE")?></span>
	<ul>
		<?foreach ($arResult as $arItem):?>
			<?$selected = $arItem["SELECTED"] ? "active" : ""?>
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endforeach?>
	</ul>
</div>

