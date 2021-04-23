<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arItem = $arParams;
$actualPrice = $price = $arItem["ITEM_PRICES"][0]["PRINT_PRICE"]

?>


<div class="product-card-box">
	<div class="product-thumb">
		<a href="<?=$arResult["DETAIL_PAGE_URL"]?>">

			<div class="nameplates ns">
				<!--noindex-->
				<?foreach($arResult["ICONS"] as $arIcon):?>
					<span class="nameplates-item color-<?=$arIcon["COLOR"]?>"><?=$arIcon["TEXT"]?></span>
				<?endforeach;?>
				<!--/noindex-->
			</div>

			<img data-src="<?=$arResult["IMG"]?>" alt="<?=$arResult["NAME"]?>" src="/">
		</a>
	</div>
	<div class="product-body">
		<span class="sku">
			<?if ($arResult["PROPERTIES"]["ART_NUMBER"]["VALUE"]):?>
				Артикул: <?=$arResult["PROPERTIES"]["ART_NUMBER"]["VALUE"]?>
			<?endif?>
		</span>
		<div class="name">
			<a href="<?=$arResult["DETAIL_PAGE_URL"]?>" title="<?=$arResult["NAME"]?>">
				<?=$arResult["NAME"]?>
			</a>
		</div>
		<div class="seo-txt">
			<?if ($arResult["EXP_DATE"] && $arResult["EXP_PRICE"]):?>
				-СПЕЦИАЛЬНАЯ ЦЕНА: <?=$arResult["EXP_PRICE"]?> руб. <br>
				-Товар ограничен по кол-ву. <br>
				-ОСГ: <?=$arResult["EXP_DATE"]?> г. <br>
			<?else:?>
				<?=$arResult["PROPERTIES"]["SEO_TXT"]["VALUE"]?>
			<?endif?>
		</div>

		<?$arPrice = $arResult["PRICES"]?>

		<div class="discount-block">
			<?if ( $arPrice["OLD"] && $arPrice["DISCOUNT"] ):?>
				<div class="price-old">
					<?=$arPrice["OLD"]?> руб.
				</div>
				<div class="price-discount">
					<?=$arPrice["DISCOUNT"]?>%
				</div>
			<?endif?>
		</div>


		<div class="price-block">
			<?if ( $arPrice[ "NEW" ] ):?>
				<?=$arPrice[ "NEW" ]?> руб.
			<?else:?>
				Цена: по запросу
			<?endif;?>
		</div>
		<div class="country-list">
			<?if (is_array($arResult[ "COUNTRIES" ])):?>
				<? foreach ( $arResult[ "COUNTRIES" ] as $arCountry ): ?>
					<img src="<?=$arCountry[ "SRC" ]?>" alt="">
				<? endforeach ?>
			<?endif?>
		</div>
	</div>
</div>