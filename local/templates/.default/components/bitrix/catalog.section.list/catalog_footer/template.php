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

$arSections = array();
foreach ( $arResult[ "SECTIONS" ] as $arSection ) {
	if ($arSection["ELEMENT_CNT"] <= 0) continue;
	$arSections[] = $arSection;
}

$halfSize = round(count($arSections)/2);

$res = array_chunk( $arSections, $halfSize );
?>


<div class="footer-menu-col">
	<span class="title">Каталог товаров</span>
	<ul>
		<?foreach ( $res[0] as $arSection ):?>
			<li>
				<a href="<?=getCatalogSectionUrl($arSection["ID"]);?>">
					<?=$arSection[ "NAME" ]?>
				</a>
			</li>
		<?endforeach?>
	</ul>
</div>
<div class="footer-menu-col">
	<ul>
		<?foreach ( $res[1] as $arSection ):?>
			<li>
				<a href="<?=getCatalogSectionUrl($arSection["ID"]);?>">
					<?=$arSection[ "NAME" ]?>
				</a>
			</li>
		<?endforeach?>
	</ul>
	<span class="footer-callback2" onclick="$('#backcall-modal').arcticmodal();">Обратная связь</span>
</div>



