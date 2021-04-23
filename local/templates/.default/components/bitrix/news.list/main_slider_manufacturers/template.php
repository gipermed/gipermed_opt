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


<? if ( count($arResult["ITEMS"]) > 0 ): ?>
	<div class="section">
		<div class="heading"><p class="h2"><?=$arParams["HEADER"]?></p></div>
		<div class="manufacturer-carousel clearfix">
			<?foreach ($arResult["ITEMS"] as $arItem):?>
				<div class="carousel-cell">
					<div class="manufacturer-block">
						<a href="<?=$arItem[ "DETAIL_PAGE_URL" ]?>">
							<div class="manufacturer-box">
								<div class="img-wrap">
									<img src="<?=$arItem[ "SRC" ]?>" alt="<?=$arItem["NAME"]?>">
								</div>
							</div>
						</a>
					</div>
				</div>
			<?endforeach?>
		</div>
		<div class="more clearfix">
			<a href="<?=$arResult[ "LIST_PAGE_URL" ]?>" class="all-news">
				<?=GetMessage("NL_MS_LIST_URL")?>
				<i class="all-news-icon"></i>
			</a>
		</div>
	</div>
<?endif?>