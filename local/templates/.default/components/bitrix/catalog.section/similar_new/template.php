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
	<div class="product-section">
		<div class="section-title"><?=GetMessage("CS_SIMILAR_HEADER");?></div>
		<div class="products-slider swiper-container">
			<button class="slider-arrow slider-arrow-prev" aria-label="Назад">
				<svg width="12" height="12"><use xlink:href="#icon-angle-left"/></svg>
			</button>
			<button class="slider-arrow slider-arrow-next" aria-label="Вперед">
				<svg width="12" height="12"><use xlink:href="#icon-angle-right"/></svg>
			</button>
			<div class="swiper-wrapper">
				<? foreach( $arResult[ "ITEMS" ] as $arItem ): ?>
					<div class="products-col flex-row-item swiper-slide">
						<div class="product-item">
							<? $APPLICATION->IncludeComponent( "gipermed:catalog.element.template", "new", $arItem ) ?>
						</div>
					</div>
				<? endforeach ?>
			</div>
		</div>

		<div class="read-more-link-wrapp">
			<a href="/catalog/similar/<?=$arParams["TARGET_ID"]?>/" class="read-more-link">
				<span><?=GetMessage("CS_SIMILAR_ALL");?></span>
				<svg width="20" height="15"><use xlink:href="#icon-arrow-right"></use></svg>
			</a>
		</div>
	</div>
<?endif?>

	
		
					
			