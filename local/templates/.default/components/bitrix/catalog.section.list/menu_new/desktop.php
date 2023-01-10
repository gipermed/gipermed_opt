<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$maxItemsToShow = $arParams["SHOW_SECTIONS_NUM"];
$rootSectionId = $arParams["SECTION_ID"] ?: "ROOT";
$rootSectionsCnt = count( $arResult[ "TREE" ][ $rootSectionId ] );
$showMore = $rootSectionsCnt > $maxItemsToShow;
?>
<div class="header__catalog">
	<p class="header__catalog-name">
		<a href="/catalog/" class="full"></a>
		<svg class="icon icon-catalog">
			<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#catalog"></use>
		</svg>
		<span>Каталог</span>
	</p>
	<ul class="header__cat">
		<?foreach( $arResult[ "TREE" ][ $rootSectionId ] as $i => $sectionId ):?>
		<? $sectionIndex = $arResult[ "INDEXES" ][ $sectionId ];?>
		<? $arSection = $arResult[ "SECTIONS" ][ $sectionIndex ]; ?>
		<li class="flex-row">
			<div class="flex-row">
				<div class="header__icon">
					<img src="https://gipermed.ru<?=$arSection[ "ICON" ]?>" alt=""/>
				</div>
				<a href="<?=$arSection[ "SECTION_PAGE_URL" ]?>"><?=$arSection[ "NAME" ]?></a>
			</div>
			<svg class="icon icon-arrow-up">
				<use xlink:href="<?=DEFAULT_TEMPLATE_PATH ?>icon/sprite.svg#arrow-up"></use>
			</svg>
			<? $arSectionChildren = $arResult[ "TREE" ][ $sectionId ]; ?>
			<? if ( is_array($arSectionChildren) && count( $arSectionChildren ) > 0 ):?>
			<div class="header__cat-inner">
				<p class="header__cat-name"><?=$arSection[ "NAME" ]?></p>
				<ul>
					<?foreach ( $arSectionChildren as $subSectionId ):?>
					<? $subSectionIndex = $arResult[ "INDEXES" ][ $subSectionId ]; ?>
					<? $arSubSection = $arResult[ "SECTIONS" ][ $subSectionIndex ]?>
						<li><a href="<?=$arSubSection["SECTION_PAGE_URL"]?>"><?=$arSubSection["NAME"]?><span>(<?=$arSubSection["ELEMENT_CNT"]?>)</span></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?endif?>
		</li>
		<?php endforeach; ?>
	</ul>
</div>