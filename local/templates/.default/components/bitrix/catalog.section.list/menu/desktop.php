<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$maxItemsToShow = $arParams["SHOW_SECTIONS_NUM"];
$rootSectionId = $arParams["SECTION_ID"] ?: "ROOT";
$rootSectionsCnt = count( $arResult[ "TREE" ][ $rootSectionId ] );
$showMore = $rootSectionsCnt > $maxItemsToShow;
?>
<div class="catalog-list">
	<?foreach( $arResult[ "TREE" ][ $rootSectionId ] as $i => $sectionId ):?>
		<? $sectionIndex = $arResult[ "INDEXES" ][ $sectionId ];?>
		<? $arSection = $arResult[ "SECTIONS" ][ $sectionIndex ]; ?>

		<div class="catalog-item">
			<span class="item-icon">
				<img src="<?=$arSection[ "ICON" ]?>" alt="">
			</span>
			<a href="<?=$arSection[ "SECTION_PAGE_URL" ]?>">
				<?=$arSection[ "NAME" ]?>
			</a>

			<? $arSectionChildren = $arResult[ "TREE" ][ $sectionId ]; ?>
			<? if ( is_array($arSectionChildren) && count( $arSectionChildren ) > 0 ):?>
				<span class="shevron"></span>
				<div class="catalog-sub">
					<div class="catalog-sub-wrap clearfix">
						<div class="catalog-submenu-item">
							<ul class="catalog-submenu">
								<?foreach ( $arSectionChildren as $subSectionId ):?>
									<? $subSectionIndex = $arResult[ "INDEXES" ][ $subSectionId ]; ?>
									<? $arSubSection = $arResult[ "SECTIONS" ][ $subSectionIndex ]?>
									<li class="catalog-submenu-subitem">
										<a href="<?=$arSubSection["SECTION_PAGE_URL"]?>">
											<?=$arSubSection["NAME"]?>
										</a>
										<span class="cat-cnt">(<?=$arSubSection["ELEMENT_CNT"]?>)</span>
									</li>
								<?endforeach?>
							</ul>
						</div>
					</div>
				</div>
			<?endif?>
		</div>

		<?if ( $showMore ):?>
			<?if ( $i + 1 == $maxItemsToShow ):?>
				<div style="display:none" class="cat-menu-hidden js-show-more-cat-hidden">
			<?elseif ( $i + 1 == $rootSectionsCnt ):?>
				</div>
				<div class="more">
					<a href="#" class="see-more js-show-more-cat">Показать еще</a>
				</div>
			<?endif?>
		<?endif?>
	<?endforeach?>
</div>