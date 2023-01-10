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
	<div class="related-products">
		<div class="heading">
			<h3><?=GetMessage("CS_RELATED_HEADER");?></h3>
		</div>
		<div class="related-products-wrap">
			<? foreach( $arResult[ "ITEMS" ] as $arItem ): ?>
				<div class="product-card">
					<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "", $arItem ) ?>
			</div>
			<? endforeach ?>
		</div>
	</div>
	<div class="more">
		<a href="/catalog/related/<?=$arParams["TARGET_ID"]?>/" class="all-product">
			<?=GetMessage("CS_RELATED_ALL");?>
		</a>
	</div>
<?endif?>