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

<div class="page-title left-col">
	<h1><?=$arResult["NAME"]?></h1>
</div>

<div class="right-col brand-block">
	<?if (is_array($arResult["MANUFACTURERS"])):?>
		<?foreach($arResult["MANUFACTURERS"] as $arItem):?>
			<div class="brand">
				<a href="<?=$arItem[ "URL" ]?>">
					<div class="brand-img-wrap">
						<img src="<?=$arItem[ "SRC" ]?>" alt="<?=$arItem[ "NAME" ]?>">
					</div>
				</a>
			</div>
		<?endforeach?>
	<?endif?>
</div>
<div class="product-content" data-alt-url="<?=$arResult["ALT_PAGE_URL"]?>">
	<div class="product-slider-wrap arrows-middle-height arrows-vertical clearfix">
		<div class="nameplates nameplates_detail">
			<!--noindex-->
			<?foreach($arResult["ICONS"] as $arIcon):?>
				<span class="nameplates-item color-<?=$arIcon["COLOR"]?>"><?=$arIcon["TEXT"]?></span>
			<?endforeach;?>
			<!--/noindex-->
		</div>
		<?if ($arResult["EXP_DATE"] && $arResult["EXP_PRICE"]):?>
			<div class="exp">
				<div class="exp__price"><?=$arResult["EXP_PRICE"]?> &#8381;</div>
				<div class="exp__date">ОСГ: <?=$arResult["EXP_DATE"]?></div>
			</div>
		<?endif?>
		<div class="product-slider">

			<? foreach( $arResult[ "IMG" ] as $arImg ): 
				?>
                <a data-fancybox="gallery" href="<?= $arImg["ORIGINAL"] ?>" rel="group" class="product-slider-cell ">
					<img src="<?=$arImg[ "BIG" ]?>" alt="<?=$arResult["NAME"]?>">
                </a>
			<? endforeach ?>
		</div>

		<div class="product-slider-nav">
			<? foreach( $arResult[ "IMG" ] as $arImg ): ?>
				<div class="product-slider-nav-cell">
					<img src="<?=$arImg[ "SMALL" ]?>" alt="<?=$arResult["NAME"]?>">
				</div>
			<? endforeach ?>
		</div>
	</div>

	<div style="overflow: hidden;">
		<div class="right-col">
			<?//https://tech.yandex.ru/share/?>
			<?$this->addExternalJS("//yastatic.net/share2/share.js");?>
			<?$this->addExternalJS("//yastatic.net/es5-shims/0.0.2/es5-shims.min.js");?>
			<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter"></div>
		</div>
	</div>

	<div class="product-desc">
		<h2><?=GetMessage("CE_DEF_DESC")?></h2>
        <div style="text-align: justify; font-family: Arial; font-size: 11pt;">
		    <?=$arResult["DETAIL_TEXT"]?>
        </div>
	</div>
	<? $arChars = $arResult[ "PROPERTIES" ][ "CHARACTERISTICS" ] ?>
	<? if ( $arChars["VALUE"] ):?>
		<div class="characteristics clearfix">
			<h2><?=GetMessage("CE_DEF_CHAR")?></h2>
			<ul>
				<? foreach ( $arChars["VALUE"] as $i => $char): ?>
					<? $val = $arChars[ "DESCRIPTION" ][ $i ]; ?>
					<li>
						<span class="name">
							<b><?=$char?>:</b>
						</span>
						<span class="value">
							<?=$val?>
						</span>
					</li>
				<? endforeach ?>
			</ul>
		</div>
	<? endif ?>

	<? if ( $arResult["DOCS"] ): ?>
		<div class="docs">
			<h2><?=GetMessage("CE_DEF_DOSC")?></h2>
			<? foreach ( $arResult["DOCS"] as $arDoc ): ?>
				<div class="doc">
					<div class="doc-icon">
						<img src="/local/templates/.default/img/doc.svg" alt="<?=$arDoc["ORIGINAL_NAME"]?>">
					</div>
					<div class="doc-body">
						<a href="<?=$arDoc["SRC"]?>" download class="name">
							<?=$arDoc["ORIGINAL_NAME"]?>
						</a>
						<span class="amount"><?=$arDoc["FILE_SIZE"]?></span>
					</div>
				</div>
			<? endforeach ?>
		</div>
	<? endif ?>

	<? if ( is_array($arResult[ "MANUFACTURERS" ]) && count( $arResult[ "MANUFACTURERS" ] ) ): ?>
		<div class="product-manufacturers">
			<h2><?=GetMessage("CE_DEF_MANUFACTURERS")?></h2>
			<?foreach ( $arResult[ "MANUFACTURERS" ] as $arItem ):?>
				<?$arCountry = $arResult["COUNTRIES"][$arItem["COUNTRY"]]?>
				<div class="product-manufacturer">
					<?=$arItem[ "NAME" ]?>
					<? if ( $arItem[ "SRC" ] ): ?>
						<img src="<?=$arCountry[ "SRC" ]?>" alt="" class="flag">
					<? endif ?>
					<?=$arCountry["UF_NAME"]?>
				</div>
			<? endforeach ?>
		</div>
	<? endif ?>
</div>


<? $this->SetViewTarget('DETAIL_SIDEBAR_INFO'); ?>
	<div class="product-info">
		<div class="cost-block">
			<? $price = $arResult["PRICES"] ?>
			<? if ( $price[ "NEW" ] ): ?>
				<?if ( $price["OLD"] ):?>
					<span class="old-price"><?=$price[ "OLD" ]?> руб.</span>
					<span class="new-price"><?=$price[ "NEW" ]?> руб.</span>
				<?else:?>
					<span class="price"><?=$price[ "NEW" ]?> руб.</span>
				<?endif?>
			<?else:?>
				<span class="no-price">
					Цена: по запросу
				</span>
			<?endif?>
			<a href="" class="find-out-btn" onclick="$('#cost-modal').arcticmodal();">Уточнить стоимость</a>
			<a href="//gipermed.com<?=$arResult["DETAIL_PAGE_URL"]?>" class="red-btn">Купить в розницу</a>
			<a href="" class="contact-manager" onclick="$('#contact-manager').arcticmodal();">Связаться с менеджером</a>

		</div>
		<div class="delivery-block">
			<span class="heading">Способы отгрузки</span>
			<div class="delivery-item active">
				<div class="heading">Самовывоз</div>
				<div class="delivery-body">
					Москва, ул. Рябиновая д.53
					<a target="_blank" href="/contacts/#scheme">схема</a>
				</div>
			</div>
			<div class="delivery-item">
				<div class="heading">Транспортные компании</div>
				<div class="delivery-body">
					<span><b>Бесплатная доставка до терминалов ТК:</b></span>
					<ul class="delivery-list">
						<li>
							<div class="thumb"><img src="/local/templates/.default/img/photo/d-1.png" alt=""></div>
							<div class="name"><span>Деловые линии</span></div>
						</li>
						<li>
							<div class="thumb"><img src="/local/templates/.default/img/photo/d-2.png" alt=""></div>
							<div class="name"><span>ПЭК</span></div>
						</li>
						<li>
							<div class="thumb"><img src="/local/templates/.default/img/photo/d-4.png" alt=""></div>
							<div class="name"><span>ЖелДорЭкспедиция</span></div>
						</li>
						<li>
							<div class="thumb"><img src="/local/templates/.default/img/photo/d-5.png" alt=""></div>
							<div class="name"><span>КИТ</span></div>
						</li>
						<li>
							<div class="thumb"><img src="/local/templates/.default/img/photo/d-6.png" alt=""></div>
							<div class="name"><span>ЖелдорАльянс</span></div>
						</li>
						<li>
							<div class="thumb"><img src="/local/templates/.default/img/photo/d-7.png" alt=""></div>
							<div class="name"><span>Байкал Сервис</span></div>
						</li>
					</ul>
				</div>
			</div>
			<div class="delivery-item">
				<div class="heading">Доставка</div>
				<div class="delivery-body">
					<span><b>Москва / Подмосковье</b></span><br>
					<span>Заказ > 25 000 руб. <b>БЕСПЛАТНО</b></span><br>
					<span>Заказ < 25 000 руб. <b>от 500 руб.</b></span><br>
					<span class="red">Возможны индивидуальные условия</span><br>
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
<? $this->EndViewTarget(); ?>