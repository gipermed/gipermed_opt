<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->setFrameMode(true);
	$arItem = $arParams;
	$actualPrice = $price = $arItem["ITEM_PRICES"][0]["PRINT_PRICE"]

?>

<?
	$arPrice = $arResult["PRICES"];

	if($arResult['PROPERTIES']['NEW']['VALUE']) {
		$exclusiv = 'new';
	 } elseif($arResult['PROPERTIES']['PRICE_WHOLESALE_OLD']['VALUE']) {
		$exclusiv = 'sale'; 
	 }  else {
		$exclusiv = ''; 
	 }

?>



<?$qty = $arResult["PRODUCT"]["QUANTITY"]?>

<a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="product-item-link" aria-label="На страницу товара"></a>


<div class="product-item-img">
	<img data-src="<?=$arResult["DETAIL_PICTURE"]['SRC']?>" alt="<?=$arResult["NAME"]?>" src="<?= !empty($arResult["DETAIL_PICTURE"]['SRC']) ? $arResult["DETAIL_PICTURE"]['SRC'] : $arResult["PREVIEW_PICTURE"]['SRC'] ?>">
</div>
<div class="product-item-title"><?=$arResult["NAME"]?></div>

<?php 
	if(!empty($arResult['PROPERTIES']['SEO_TXT']['VALUE'])):
	?>
	<p class="product-item-desc"><?= $arResult['PROPERTIES']['SEO_TXT']['VALUE'] ?></p>
	<?php endif;?>
<div class="product-item-foot">
	<div class="product-item-made-in">
		<?foreach ( $arResult[ "COUNTRIES" ] as $arCountry ): ?>
			<img src="<?=$arCountry[ "SRC" ]?>" alt="">
			<span><?=$arCountry["UF_NAME"]?></span>
			&nbsp;&nbsp;
			<?endforeach ?>
	</div>
	<?php $arPrice["NEW"] = $arResult['PROPERTIES']['PRICE_WHOLESALE']['VALUE']; ?>
	<div class="product-item-prices">
		<div class="product-item-price">
			<?if(floatval($arPrice[ "NEW" ]) > 0) echo $arPrice["NEW"].' руб.'; else echo 'По запросу';?>
		</div>
	</div>
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
