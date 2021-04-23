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
$maxItemsToShow = $arParams["SHOW_SECTIONS_NUM"];
$rootSectionId = $arParams["SECTION_ID"] ?: "ROOT";
$rootSectionsCnt = count( $arResult[ "TREE" ][ $rootSectionId ] );
$showMore = $rootSectionsCnt > $maxItemsToShow;
?>
<article class="category--mob">
	<section class="category--mob__list flex-wrap">
		<?foreach( $arResult[ "TREE" ][ $rootSectionId ] as $i => $sectionId ):?>
		<? $sectionIndex = $arResult[ "INDEXES" ][ $sectionId ];?>
		<? $arSection = $arResult[ "SECTIONS" ][ $sectionIndex ]; ?>
		<? $icon = CFile::GetPath($arSection['UF_SVG_IMG']); ?>
		<div class="category--mob__item">
			<a href="<?=$arSection[ "SECTION_PAGE_URL" ]?>"></a>
			<div class="category--mob__img">
				<img src="<?= $icon ?>" alt=""/>
			</div>
			<p class="category--mob__name"><?=$arSection[ "NAME" ]?></p>
		</div>
		<?endforeach?>
	</section>
</article>