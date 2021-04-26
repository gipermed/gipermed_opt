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


	$defBoxing = 1;
	$multipleSizes = false;
	$singleSizing = false;

	$arSingleBoxing = $arResult["PROPERTIES"]["BOXING"]["VALUE"];

	$arSizes = $arResult["PROPERTIES"]["SIZES_AND_BOXING"]["VALUE"] ;
	$arBoxing = $arResult["PROPERTIES"]["SIZES_AND_BOXING"]["DESCRIPTION"];
	$arValueIds = $arResult["PROPERTIES"]["SIZES_AND_BOXING"]["PROPERTY_VALUE_ID"];


	if ( is_array($arSizes) && count($arSizes) ) {
		$multipleSizes = true;
		$defBoxing = $arBoxing[0];
	}

	if ( $arSingleBoxing > 0 ) {
		$singleSizing = true;
		$defBoxing = $arSingleBoxing;
	}
	

	$freeDelivery = $arResult["PROPERTIES"]["MOSCOW_FREE_DELIVERY"]["VALUE"] ? "data-free-delivery='y'" : "";?>

	<style>
	.product-gallery {
		display: relative;
	}
	.product-gallery__discount-sticker {
		position: absolute;
		width: 129px;
		height: 40px;
		border-radius: 3px;
		background: linear-gradient(111.96deg, #B721FF 0%, #21D4FD 100%);
		z-index: 2;
		top: 20px;
		left: 25%;
		padding: 5px 10px;
	}
	.product-gallery__discount-sticker span {
		color: white;
	}
	@media (max-width: 480px) {
		.product-gallery__discount-sticker {
			top: 5px;
			left: 10px;
		}
	}
	</style>
<div class="product-head">
	<div class="product-head-title">
		<h1 class="page-title product-title"><?=$arResult["NAME"]?></h1>
		<div class="product-code">Артикул: <?=$arResult["DISPLAY_PROPERTIES"]["ART_NUMBER"]["DISPLAY_VALUE"]?></div>
	</div>
	<?if ( is_array($arResult["MANUFACTURERS"]) && count($arResult["MANUFACTURERS"]) ):
			$manufact[] = $arResult["MANUFACTURERS"]?>	
		<?foreach($manufact[0] as $arItem):?>
			<a href="<?=$arItem['URL']?>" class="product-brand hidden-mobile">
				<img src="<?=$arItem['SRC']?>" alt="<?=$arItem['NAME']?>">
			</a>
			<?endforeach;?>
		<?endif;?>
</div>
<div class="product" data-alt-url="<?=$arResult["ALT_PAGE_URL"]?>" <?=$freeDelivery?> >
	<div class="product-gallery">
		<div class="product-gallery-nav swiper-container">
			<button class="slider-arrow slider-arrow-prev" aria-label="Назад">
				<svg width="12" height="12"><use xlink:href="#icon-angle-left"/></svg>
			</button>
			<button class="slider-arrow slider-arrow-next" aria-label="Вперед">
				<svg width="12" height="12"><use xlink:href="#icon-angle-right"/></svg>
			</button>
			<div class="swiper-wrapper">
				<?if (is_array($arResult[ "IMG" ])):?>
					<? foreach( $arResult[ "IMG" ] as $arImg ): ?>
						<div class="product-gallery-nav-slide swiper-slide">
							<div class="product-img">
								<img src="<?=$arImg[ "BIG" ]?>" srcset="<?=$arImg[ "BIG" ]?> 1x,<?=$arImg[ "BIG" ]?> 2x" alt="<?=$arResult["NAME"]?>">
							</div>
						</div>
						<? endforeach ?>
					<? endif ?>
			</div>
		</div>
		<div class="product-gallery-main zoom-link">
			<?$arPrice = $arResult["PRICES"]?>
			<?$qty = $arResult["PRODUCT"]["QUANTITY"]?>
			<?if ( $qty && $arPrice["OLD"] && $arPrice["DISCOUNT"] ):?>	
				<div class="product-item-stikers">
					<div class="product-item-stiker product-item-stiker-sale">Скидка</div>
				</div>
				<div class="product-item-sale"><?=$arPrice["DISCOUNT"]?>%</div>
				<?endif;?>
			<div class="product-gallery-slider swiper-container">
				<div class="swiper-wrapper">
					<?if (is_array($arResult[ "IMG" ])):?>
						<? foreach( $arResult[ "IMG" ] as $arImg ): ?>
							<div class="product-gallery-slide swiper-slide">
								<a href="<?=$arImg[ "ORIGINAL" ]?>" class="product-img" data-fancybox="product" data-type="image">
									<img src="<?=$arImg[ "BIG" ]?>" srcset="<?=$arImg[ "BIG" ]?> 1x,<?=$arImg[ "BIG" ]?> 2x" alt="<?=$arResult["NAME"]?>">
								</a>
							</div>
							<? endforeach ?>
						<? endif ?>
				</div>
			</div>
			<svg width="24" height="24" class="zoom-icon"><use xlink:href="#icon-zoom"/></svg>
		</div>
	  <?php if($arResult['PROPERTIES']['ASK_DISCOUNT']['VALUE']): ?>
		<div class="product-gallery__discount-sticker">
			<span>Уточните скидку у менеджера</span>
		</div>
	  <?php endif;?>	
	</div>

	<div class="product-body">
		<div class="product-form">
			<div class="product-form-info">
				<div class="product-prices">
					<? $price = $arResult["PRICES"];?>
					<?
						$price["NEW"] = $arResult['PROPERTIES']['PRICE_WHOLESALE']['VALUE'];
						$price["OLD"] = $arResult['PROPERTIES']['PRICE_WHOLESALE_OLD']['VALUE'];
					?>
					<? $qty = $arResult["PRODUCT"]["QUANTITY"];?>
					<?if ( $price["OLD"] ):?>
						<div class="product-price-old"><b>Цена</b> <span><?=$price[ "OLD" ]?></span></div>
						<?endif?>	
					<div class="product-price"><?if(floatval($price[ "NEW" ]) > 0) echo $price["NEW"].' руб.'; else echo 'По запросу';?></div>
				</div>
				<? if ($arSizes) : ?>
					<div class="product-size">
						<div class="product-size-title">Размер</div>
						<?foreach ($arSizes as $i => $size):?>
							<?$boxing = $arBoxing[$i]?>
							<?$id = $arValueIds[$i]?>
							<div class="product-size-data"><?=$size?></div>
							<?endforeach?>
					</div>
					<? endif; ?>
				<a onclick="$('#contact-manager').arcticmodal();" href="#modal-request" class="product-request-btn btn btn-red btn-full modal-open-btn" data-url="<?=$arResult["DETAIL_PAGE_URL"]?>" data-name="<?=$arResult["NAME"]?>">Запросить счёт</a>
				<div class="product-form-desc">В ближайшее время наш менеджер свяжется с вами для обсуждения деталей заказа</div>
			</div>
			<div class="product-form-buy">
				<a href="//gipermed.com<?=$arResult["DETAIL_PAGE_URL"]?>" class="product-buy-btn btn btn-full btn-blue" rel="nofollow">Купить в розницу</a>
				<div class="product-form-desc">Переход на сайт для розничных покупателей (физических лиц) www.gipermed.com</div>
				<div class="product-buy-alert">
					<img src="/local/templates/.default/img/new/alert-icon.svg" width="24" alt="">
					<div class="product-buy-alert-desc">Цена для физических и юридических лиц может отличаться</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="product-section">
<ul class="product-info-tabs-nav tabs-nav" data-tabs="#product-info-tabs">
	<li class="active"><a href="#product-info-tab-1"><?=GetMessage("CE_DEF_DESC")?></a></li>
	<li><a href="#product-info-tab-2">Характеристики</a></li>
	<li><a href="#product-info-tab-3">Документация</a></li>
	<?if ($arResult["VIDEO_CODE"]):?>
		<li><a href="#product-info-tab-4">Видеообзор</a></li>
		<?endif?>		
</ul>

<div id="product-info-tabs" class="tabs-wrapp">
<div id="product-info-tab-1" class="product-info-tab tab-block active">
	<div class="product-info-tab-title"><span><?=GetMessage("CE_DEF_DESC")?></span></div>
	<div class="product-info-content">
		<div class="product-info-desc">	
			<?=$arResult["DETAIL_TEXT"]?>
		</div>
	</div>
	<div class="product-info-content-toggle-wrapp">
		<a href="#" class="product-info-content-toggle" data-text="Развернуть <?=GetMessage("CE_DEF_DESC")?>" data-text-active="Свернуть описание">
			<span>Развернуть <?=GetMessage("CE_DEF_DESC")?></span>
			<svg width="12" height="8"><use xlink:href="#icon-angle-bottom"/></svg>
		</a>
	</div>
</div>
<div id="product-info-tab-2" class="product-info-tab tab-block">
	<div class="product-info-tab-title"><span><?=GetMessage("CE_DEF_CHAR")?></span></div>
	<div class="product-info-content">
		<div class="product-characteristics">
			<? $arChars = $arResult[ "PROPERTIES" ][ "CML2_ATTRIBUTES" ];?>
			<? if ($arChars['VALUE']) : ?>
				<div class="product-characteristics-content">
					<div class="content-title product-characteristics-title"><?=$arChars['NAME']?>:</div>
					<div class="content-text">
						<ul>
							<? foreach ( $arChars["VALUE"] as $i => $char): ?>
								<li><?=$char?></li>
								<? endforeach ?>	
						</ul>
					</div>
				</div>
				<? endif; ?>
			<div class="product-characteristics-body">
				<div class="content-title product-characteristics-title"><?=GetMessage("CE_DEF_CHAR")?>:</div>
				<div class="content-text">
					<? $arCharsTech = $arResult[ "PROPERTIES" ][ "CHARACTERISTICS" ]; ?>
					<div class="content-table">
						<? if ( $arCharsTech["VALUE"] ):?>
							<table>
								<? foreach ( $arCharsTech["VALUE"] as $i => $char): ?>
									<? $val = $arCharsTech[ "DESCRIPTION" ][ $i ]; ?>
									<tr>
										<td class="name">
											<?=$char?>:
										</td>
										<td class="value">
											<?=$val?>
										</td>
									</tr>
									<? endforeach ?>
							</table>
							<? endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="product-info-content-toggle-wrapp">
		<a href="#" class="product-info-content-toggle" data-text="Развернуть характеристики" data-text-active="Свернуть <?=GetMessage("CE_DEF_CHAR")?>">
			<span>Развернуть <?=GetMessage("CE_DEF_CHAR")?></span>
			<svg width="8" height="12"><use xlink:href="#icon-angle-bottom"/></svg>
		</a>
	</div>
</div>

<div id="product-info-tab-3" class="product-info-tab tab-block">
	<div class="product-info-tab-title"><span><?=GetMessage("CE_DEF_DOSC")?></span></div>
	<div class="product-docs">
		<div class="product-docs-body">
			<? if ( $arResult["DOCS"] ): ?>
				<div class="product-docs-title"><?=GetMessage("CE_DEF_DOSC")?>:</div>
				<ul class="docs-list">
					<? foreach ( $arResult["DOCS"] as $arDoc ): ?>
						<li>
							<a href="<?=$arDoc["SRC"]?>" class="doc-link">
								<span class="doc-link-icon">
									<img src="/local/templates/.default/img/new/doc-icon.svg" alt="">
								</span>
								<span class="doc-link-body">
									<span class="doc-link-title"><?=$arDoc["ORIGINAL_NAME"]?></span>
									<span class="doc-link-size">Скачать: <?=$arDoc["FILE_SIZE"]?></span>
								</span>
							</a>
						</li>
						<? endforeach ?>
				</ul>
				<? endif ?>
		</div>
<!--*********-->
<div style="display: none;">
<pre>
<?php var_dump($arResult['PROPERTIES']['PROD_COUNTRY']['USER_TYPE_SETTINGS']['TABLE_NAME']) ?>
</pre>
</div>
<!--*********-->
		<div class="product-info-brand">
			<? if ( is_array( $arResult[ "MANUFACTURERS" ] ) && count( $arResult[ "MANUFACTURERS" ] ) ): ?>
				<div class="product-docs-title"><?=GetMessage("CE_DEF_MANUFACTURERS")?>:</div>
				<?foreach ( $arResult[ "MANUFACTURERS" ] as $arItem ):?>
					<?$arCountry = $arResult["COUNTRIES"][$arItem["COUNTRY"]]?>
					<a href="<?=$arItem[ "URL" ]?>" class="product-brand visible-mobile">
						<img src="<?=$arItem[ "SRC" ]?>" alt="">
					</a>
					<div class="product-info-made-in">
						<span><?=$arItem[ "NAME" ]?></span>
						<span class="product-info-made-in-country">
							<img src="<?=$arCountry[ "SRC" ]?>" alt="<?=$arCountry["UF_NAME"]?>">
							<span><?=$arCountry["UF_NAME"]?></span>
						</span>
					</div>
					<? endforeach ?>
			<? endif ?>

			<? if ( is_array( $arResult['PROPERTIES']['PROD_COUNTRY'] ) && count( $arResult['PROPERTIES']['PROD_COUNTRY']['VALUE'] ) ): ?>
				<div class="product-docs-title country-title">Страна производства:</div>
				<?php $hlbName = $arResult['PROPERTIES']['PROD_COUNTRY']['USER_TYPE_SETTINGS']['TABLE_NAME'];?>
				<div class="product-item-made-in country-small-container">
					<?foreach ( $arResult['PROPERTIES']['PROD_COUNTRY'][ "VALUE" ] as $arCountry ): ?>
						<?php $countryName = getValFromHLB($hlbName, $arCountry,'UF_NAME'); ?>
						<span class="product-info-made-in-country">
							<img src="<?=CFile::GetPath(getValFromHLB($hlbName, $arCountry,'UF_FILE'))?>" alt="<?=$countryName?>">
							<span><?=$countryName?></span>
						</span>

					<?endforeach ?>
				</div>
			<? endif ?>


		</div>
	</div>
</div>

<?if ($arResult["VIDEO_CODE"]):?>
	<div id="product-info-tab-4" class="product-info-tab tab-block">
		<div class="product-info-tab-title"><span>Видеообзор</span></div>
		<div class="product-video-title"><?=$arResult[ "NAME" ]?></div>
		<div class="product-video">
			<div class="product-video-frame">
				<?=$arResult["VIDEO_CODE"]?>

				<!-- <a href="https://www.youtube.com/embed/CLxpgRqxtEA?autoplay=1&rel=0" class="youtube-video-link" data-fancybox data-type="iframe">
				<span class="youtube-video-link-logo">
				<img src="/local/templates/.default/img/new/youtube-logo.svg" alt="">
				</span>
				<span class="youtube-video-link-play">
				<img src="/local/templates/.default/img/new/play-icon.svg" alt="">
				<span>Смотреть</span>
				</span>
				<img src="https://img.youtube.com/vi/CLxpgRqxtEA/maxresdefault.jpg" alt="">
				</a> -->
			</div>
			<div class="product-video-desc">
				<div class="content-text">
					Ознакомиться с видеопрезентацией различных товаров медицинского назначения, можно на нашем Youtube канале. Перейдя по ссылке, Вы найдете более 100 видеороликов, сможете увидеть комплектацию, внешний вид, характеристики товаров и многое другое. Подписывайтесь на наш канал, будьте всегда в курсе новинок от компании Гипермед - Центра торговли медицинскими товарами!
				</div>
				<a href="//youtube.com/channel/UCMb0--_oRvzGGYv-Bu_w8zQ" class="read-more-link">
					<span>Посмотреть все видеопрезентации</span>
					<svg width="20" height="15"><use xlink:href="#icon-arrow-right"></use></svg>
				</a>
			</div>
		</div>
	</div>
	<?endif;?>
	</div>


<div class="product-section">
	<div class="product-section-title">Способы отгрузки</div>
	<ul class="product-delivery-tabs-nav tabs-nav tabs-nav-default" data-tabs="#product-delivery-tabs">
		<li class="active"><a href="#product-delivery-tab-1">Самовывоз</a></li>
		<li><a href="#product-delivery-tab-2">Доставка Москва и МО</a></li>
		<li><a href="#product-delivery-tab-3">Доставка в регионы</a></li>
	</ul>
	<div id="product-delivery-tabs" class="tabs-wrapp product-delivery-tabs">
		<div id="product-delivery-tab-1" class="product-delivery-tab tab-block active">
			<div class="product-delivery">
				<div class="product-delivery-body">
					<div class="delivery-info">
						<div class="delivery-info-icon hidden-mobile">
							<img src="/local/templates/.default/img/new/delivery-icon-1.svg" alt="">
						</div>
						<div class="delivery-info-body">
							<div class="delivery-section-title">
								<div class="delivery-info-icon visible-mobile">
									<img src="/local/templates/.default/img/new/delivery-icon-1.svg" alt="">
								</div>
								<span>Самовывоз</span>
							</div>
							<div class="content-text">
								Вы можете самостоятельно забрать товар со склада по адресу:<br> <b>г. Москва, ул. Рябиновая, д. 53, стр. 2.</b> <br>
								Услуга бесплатна для всех клиентов.
							</div>
						</div>
					</div>
				</div>
				<div class="product-delivery-side">
					<div class="delivery-schema">
						<div class="delivery-schema-title">Схема проезда до склада: </div>
						<a href="/contacts/" class="delivery-schema-link">
							<img src="/local/templates/.default/img/new/delivery-schema.svg" alt="">
							<span class="read-more-link">
								<span>Подробнее</span>
								<svg width="20" height="15"><use xlink:href="#icon-arrow-right"/></svg>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div id="product-delivery-tab-2" class="product-delivery-tab tab-block">
			<div class="product-delivery">
				<div class="product-delivery-body">
					<div class="delivery-info">
						<div class="delivery-info-icon hidden-mobile">
							<img src="/local/templates/.default/img/new/delivery-icon-2.svg" alt="">
						</div>
						<div class="delivery-info-body">
							<div class="delivery-section-title">
								<div class="delivery-info-icon visible-mobile">
									<img src="/local/templates/.default/img/new/delivery-icon-2.svg" alt="">
								</div>
								<span>Доставка Москва и МО:</span>
							</div>
							<div class="content-text">
								<p>Данная услуга действует только для клиентов Москвы и Московской области. 
								Подробности вы можете узнать у менеджеров компании по телефону: <a href="tel:84951340122">8 (495) 134-01-22.</a>
							</div>
						</div>
					</div>
				</div>
				<div class="product-delivery-side">
					<div class="product-delivery-side-title">Условия доставки:</div>
					<div class="content-text">
						Заказ > 25 000 руб. - БЕСПЛАТНО<br>
						Заказ &lt; 25 000 руб. - от 500 руб.<br>
						Возможны индивидуальные условия.
					</div>
				</div>
			</div>
		</div>
		<div id="product-delivery-tab-3" class="product-delivery-tab tab-block">
			<div class="product-delivery">
				<div class="product-delivery-body">
					<div class="delivery-info">
						<div class="delivery-info-icon hidden-mobile">
							<img src="/local/templates/.default/img/new/delivery-icon-3.svg" alt="">
						</div>
						<div class="delivery-info-body">
							<div class="delivery-section-title">
								<div class="delivery-info-icon visible-mobile">
									<img src="/local/templates/.default/img/new/delivery-icon-3.svg" alt="">
								</div>
								<span>Доставка В РЕГИОНЫ</span>
							</div>
							<div class="content-text">
								<p>Доставка продукции в регионы России - осуществляется через транспортные компании. 
							</div>
							<a href="/shipment/" class="read-more-link">
								<span>Подробнее</span>
								<svg width="20" height="15"><use xlink:href="#icon-arrow-right"></use></svg>
							</a>
						</div>
					</div>
				</div>
				<div class="product-delivery-side">
					<div class="product-delivery-side-title">Бесплатная доставка до<br> терминалов ТК:</div>
					<ul class="product-delivery-logos">
						<li><a href="#"><img src="/local/templates/.default/img/new/delivery-company-logo-1.svg" alt=""></a></li>
						<li><a href="#"><img src="/local/templates/.default/img/new/delivery-company-logo-6.svg" alt=""></a></li>
						<li><a href="#"><img src="/local/templates/.default/img/new/delivery-company-logo-4.svg" alt=""></a></li>
						<li><a href="#"><img src="/local/templates/.default/img/new/delivery-company-logo-3.svg" alt=""></a></li>
						<li><a href="#"><img src="/local/templates/.default/img/new/delivery-company-logo-2.svg" alt=""></a></li>
						<li><a href="#"><img src="/local/templates/.default/img/new/delivery-company-logo-5.svg" alt=""></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<? 
	$brand = $arResult[ "MANUFACTURERS" ][0]["NAME"];
	$text = substr($arResult["DETAIL_TEXT"],0, strpos($arResult["DETAIL_TEXT"],'</p>')-1 );

	$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$url = explode('?', $url);
	$url = $url[0];
?>

<script type="application/ld+json">
	{
		"@context": "https://schema.org/",
		"@type": "Product",
		"name": "<?=$arResult["NAME"]?>",
		"image": [
			<?php foreach( $arResult[ "IMG" ] as $index => $arImg ): ?>
				"<?= isset($_SERVER['HTTPS']) ? 'https://' : 'http://' ?><?= $_SERVER['SERVER_NAME'].$arImg[ "BIG" ];?>"<?= $index != count($arResult[ "IMG" ]) - 1 ? ',' : '' ?>
				<?php
					endforeach;
			?>
		],
		"description": "<?= strip_tags($text); ?>",
		"brand": {
			"@type": "Brand",
			"name": "<?= $brand ?>"
		},
		"offers": {
			"@type": "Offer",
			"url": "<?= $url?>",
			"priceCurrency": "RUB",
			"price": "<?= str_replace(' ', '',$price[ "NEW" ]) ?>",
			"priceValidUntil": "2020-11-30",
			"itemCondition": "https://schema.org/UsedCondition",
			"availability": "https://schema.org/InStock"
		}
	}
</script>
<? $this->EndViewTarget(); 