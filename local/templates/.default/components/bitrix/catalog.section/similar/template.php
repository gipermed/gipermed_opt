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
<?if ( count( $arResult["ITEMS"] ) ):?>
	<div class="similar-product clearfix">
		<div class="heading">
			<h3><?=GetMessage("CS_SIMILAR_HEADER");?></h3>
		</div>
			<div class="similar-carousel">
				<? foreach( $arResult[ "ITEMS" ] as $arItem ): ?>
					<div class="carousel-cell">
						<div class="product-card">
							<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "", $arItem ) ?>
						</div>
						<div class="overlay"></div>
					</div>
				<? endforeach ?>
			</div>
		<div class="more">
			<a href="/catalog/similar/<?=$arParams["TARGET_ID"]?>/" class="all-product">
				<?=GetMessage("CS_SIMILAR_ALL");?>
			</a>
		</div>
	</div>
<?endif?>