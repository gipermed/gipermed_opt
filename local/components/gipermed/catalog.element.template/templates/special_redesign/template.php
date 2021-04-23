<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arItem = $arParams;
$actualPrice = $price = $arItem["ITEM_PRICES"][0]["PRINT_PRICE"]
?>

<?
	$arPrice = $arResult["PRICES"];
	$country = reset($arResult[ "COUNTRIES" ]);

	$filter = $GLOBALS[ "arrFilter" ];

	$exclusiv = '';

	if(isset($filter[0][0]['!PROPERTY_SALE']) && $filter[0][0]['!PROPERTY_SALE'] == false) {
		$exclusiv = 'sale'; 
	}
	if(isset($filter['!PROPERTY_NEW']) && $filter['!PROPERTY_NEW'] == false) {
		$exclusiv = 'new';
	}
?>
<div class="catalog__stuff flex-row swiper-slide">
	<a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="full"></a>
	<div class="catalog__img">
		<div><img src="<?=$arResult["IMG"]?>" alt="<?=$arResult["NAME"]?>"/></div>
	</div>
	<div class="catalog__text">
		<div class="catalog__name"><?=$arResult["NAME"]?></div>
		<div>
			<div class="product__country flex-row">
				<img src="https://gipermed.ru<?= $country['SRC'] ?>" alt=""/>
				<p class="country"><?= $country['UF_NAME'] ?></p>
			</div>
			<p class="price product__price">
				<?if ( $arPrice[ "NEW" ] ):?>
					<?=$arPrice[ "NEW" ]?> руб.
				<?else:?>
					Цена: по запросу
				<?endif;?>
			</p>
		</div>
	</div>
	<div class="product__badge product__badge--best">
		<p class="product__badge-name">Хит</p>
	</div>
</div>