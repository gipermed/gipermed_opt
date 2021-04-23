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
$rootSectionId = $arParams["SECTION_ID"] ?: "ROOT";
?>
	<div class="catalog-category-wrap">
		<?foreach( $arResult[ "TREE" ][ $rootSectionId ] as $sectionId ):?>
			<?
			$sectionIndex = $arResult[ "INDEXES" ][ $sectionId ];
			$arSection = $arResult[ "SECTIONS" ][ $sectionIndex ];
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="category-col" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<div class="thumb-img">
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
						<img src="<?=$arSection[ "PICTURE" ][ "SRC" ]?>" alt="">
					</a>
				</div>

				<div class="title">
					<a href="<?=$arSection["SECTION_PAGE_URL"]?>">
						<?=$arSection["NAME"]?>
					</a>
				</div>

				<?
				$arSectionChildren = $arResult[ "TREE" ][ $sectionId ];
				$sectionChildrenCnt = is_array($arSectionChildren) && count( $arSectionChildren );
				$subSectionsNum = $arParams[ "SHOW_SUBSECTIONS_NUM" ];
				$showFolder = ( $sectionChildrenCnt > $subSectionsNum );
				?>

				<?if ( is_array($arSectionChildren) ):?>
					<?foreach ( $arSectionChildren as $i => $subSectionId ):?>
						<? $subSectionIndex = $arResult[ "INDEXES" ][ $subSectionId ]; ?>
						<? $arSubSection = $arResult[ "SECTIONS" ][ $subSectionIndex ]?>

						<? $arSubSectionChildren = $arResult[ "TREE" ][ $subSectionId ]; ?>
						<? $subSubSectionHasChildren = is_array( $arSubSectionChildren ) && count( $arSubSectionChildren ) > 0; ?>

						<ul class="cat">
							<li class="cat-li">
								<div>
									<?if ( $subSubSectionHasChildren ):?>
										<div class="showPodCat"></div>
									<?endif?>
									<a href="<?=$arSubSection["SECTION_PAGE_URL"]?>">
										<?=$arSubSection["NAME"]?>
									</a>
									<span class="cat-cnt">(<?=$arSubSection["ELEMENT_CNT"]?>)</span>
								</div>
								<?if ( $subSubSectionHasChildren ):?>
									<ul class="subcat">
										<?foreach ( $arResult[ "TREE" ][ $subSectionId ] as $subSubSectionId ):?>
											<? $subSubSectionIndex = $arResult[ "INDEXES" ][ $subSubSectionId ]; ?>
											<? $arSubSubsection = $arResult[ "SECTIONS" ][ $subSubSectionIndex ]?>
											<li class="subcat-li">
												<a href="<?=$arSubSubsection["SECTION_PAGE_URL"]?>">
													<?=$arSubSubsection["NAME"]?>
												</a>
												<span class="cat-cnt">(<?=$arSubSubsection["ELEMENT_CNT"]?>)</span>
											</li>
										<?endforeach?>
									</ul>
								<?endif?>
							</li>
						</ul>

						<?if ( $showFolder ):?>
							<?if ( $i + 1 == $subSectionsNum ):?>
								<div class="hidden-box">
							<?elseif ( $i + 1 == $sectionChildrenCnt ):?>
								</div>
								<div class="more">
									<span>Еще</span>
								</div>
							<?endif?>
						<?endif?>
					<?endforeach?>
				<?endif?>
			</div>
		<?endforeach?>
	</div>