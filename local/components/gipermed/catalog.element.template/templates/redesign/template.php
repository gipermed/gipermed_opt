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


<section class="product__item swiper-slide">
	<a class="product__link" href="<?=$arResult["DETAIL_PAGE_URL"]?>"></a>
	<div class="product__img">
		<img src="<?=$arResult["DETAIL_PICTURE"]['SRC'] ? $arResult["DETAIL_PICTURE"]['SRC'] : $arResult["PREVIEW_PICTURE"]['SRC'] ?>" alt="<?=$arResult["NAME"]?>" src="/">
	</div>
	<p class="text product__name"><?=$arResult["NAME"]?></p>
	<div class="product__both">
	  <div class="product__country flex-row">
	  	<img src="<?= $country['SRC'] ?>" alt=""/>
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
	<?php
		if(isset($arPrice["DISCOUNT"]) && $exclusiv == 'sale'):
	?>
	<div class="product__badge product__badge--sale">
	  <p class="product__badge-name">Скидка</p>
	  <p class="product__badge-count"><?=$arPrice["DISCOUNT"]?>%</p>
	</div>
	<?php
		endif;
	?>
	<?php
		if($exclusiv == 'new'):
	?>
		<div class="product__badge product__badge--new">
		  <p class="product__badge-name">Новинка</p>
		</div>
	<?php
		endif;
	?>
</section>