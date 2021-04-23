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

<ul class="footer__menu footer__menu--dbl">
	<?foreach ( $arSections as $arSection ):?>
		<li class="footer__item"><a href="<?=getCatalogSectionUrl($arSection["ID"]);?>"><?= $arSection[ "NAME" ] ?></a></li>
    <?endforeach?>
</ul>



