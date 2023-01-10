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
<?if ( count($arResult["ITEMS"]) ):?>
	<div class="heading">
		<h3><?=GetMessage("ND_MS_HEADER");?></h3>
	</div>
	<div class="manufacturer-carousel no-arrow clearfix">
		<?foreach ($arResult["ITEMS"] as $arItem):?>
			<div class="carousel-cell">
				<div class="manufacturer-block">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
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
<?endif?>