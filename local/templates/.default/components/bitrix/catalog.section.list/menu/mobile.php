<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$maxItemsToShow = $arParams["SHOW_SECTIONS_NUM"];
$rootSectionId = $arParams["SECTION_ID"] ?: "ROOT";
$rootSectionsCnt = count( $arResult[ "TREE" ][ $rootSectionId ] );
$showMore = $rootSectionsCnt > $maxItemsToShow;
?>

<div class="menu-wrapper">
	<ul class="nav js-show-more-cat-mob-list">
		<?foreach( $arResult[ "TREE" ][ $rootSectionId ] as $i => $sectionId ):?>
			<? $sectionIndex = $arResult[ "INDEXES" ][ $sectionId ];?>
			<? $arSection = $arResult[ "SECTIONS" ][ $sectionIndex ]; ?>

			<? $arSectionChildren = $arResult[ "TREE" ][ $sectionId ]; ?>

			<?$addClass = ( $showMore && $i >= $maxItemsToShow ) ? "hidden" : "" ?>

			<li class="catalog-item <?=$addClass?>">
				<div>
					<span class="item-icon">
						<img src="<?=$arSection[ "ICON" ]?>" alt="">
					</span>
					<a href="<?=$arSection[ "SECTION_PAGE_URL" ]?>">
						<?=$arSection[ "NAME" ]?>
					</a>
					<? if ( is_array($arSectionChildren) && count( $arSectionChildren ) > 0 ):?>
						<span class="shevron"></span>
					<?endif?>
				</div>

				<? if ( is_array($arSectionChildren) && count( $arSectionChildren ) > 0 ):?>
					<ul>
						<?foreach ( $arSectionChildren as $subSectionId ):?>
							<? $subSectionIndex = $arResult[ "INDEXES" ][ $subSectionId ]; ?>
							<? $arSubSection = $arResult[ "SECTIONS" ][ $subSectionIndex ]?>
							<li>
								<a href="<?=$arSubSection["SECTION_PAGE_URL"]?>">
									<?=$arSubSection["NAME"]?>
								</a>
							</li>
						<?endforeach?>
					</ul>
				<?endif?>
			</li>
		<?endforeach?>
	</ul>
	<? if ( $showMore ): ?>
		<div class="more">
			<a href="#" class="see-more js-show-more-cat-mob">Показать еще</a>
		</div>
	<?endif?>
</div>